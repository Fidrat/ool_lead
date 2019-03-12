<?php
namespace OolongMedia\OolLead\Controller;

use TYPO3\CMS\Core\Utility\DebugUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

/* * *
 *
 * This file is part of the "lead" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 Fahri Tardif <f.tardif.b@gmail.com>, Oolong média
 *
 * * */
/**
 * ImportController
 */
class ImportController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * isTestRun
	 * 
	 * @var boolean 
	 */
	//private $isTestRun = true;
	private $isTestRun = false;

	/**
	 * log : will be serialized for persistence
	 * 
	 * @var array 
	 */
	protected $log = [ "msg" => [] ];

	/**
	 * $importRun
	 * 
	 * @var \OolongMedia\OolLead\Domain\Model\Import
	 */
	protected $importRun = null;

	/**
	 * leadRepository
	 * 
	 * @var \OolongMedia\OolLead\Domain\Repository\LeadRepository
	 * @inject
	 */
	protected $leadRepository = null;

	/**
	 * endUserRepository
	 * 
	 * @var \OolongMedia\OolLead\Domain\Repository\EndUserRepository
	 * @inject
	 */
	protected $endUserRepository = null;

	/**
	 * leadMoverRepository
	 * 
	 * @var \OolongMedia\OolLead\Domain\Repository\LeadMoverRepository
	 * @inject
	 */
	protected $leadMoverRepository = null;

	/**
	 * importRepository
	 * 
	 * @var \OolongMedia\OolLead\Domain\Repository\ImportRepository
	 * @inject
	 */
	protected $importRepository = null;

	/**
	 * persistenceManager
	 * 
	 * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
	 */
	protected $persistenceManager = null;

	public function getLog() {
		return $this->log;
	}

	private function initNewObjects() {
		$newLead		 = new \OolongMedia\OolLead\Domain\Model\Lead();
		$newEndUser		 = new \OolongMedia\OolLead\Domain\Model\EndUser();
		$newLeadMover	 = new \OolongMedia\OolLead\Domain\Model\LeadMover();
		
		//DebugUtility::debug( $this->settings ); die;
		
		$newLead->setPid( $this->settings[ 'pid' ][ 'lead' ] );
		$newEndUser->setPid( $this->settings[ 'pid' ][ 'endUser' ] );
		$newLeadMover->setPid( $this->settings[ 'pid' ][ 'leadMover' ] );
		return [ 'lead' => $newLead, 'endUser' => $newEndUser, 'leadMover' => $newLeadMover ];
	}

	private function initRun() {
		$this->stats[ 'skipped' ] = 0; // move in own init;
		
		$this->importRun = new \OolongMedia\OolLead\Domain\Model\Import();
		$this->importRun->setPid( $this->settings[ 'pid' ][ 'import' ] );
		$this->importRun->setRunStartTime( new \DateTime() );
		$this->importRepository->add( $this->importRun );
		$this->log[ 'msg' ][ 'Run type' ]	 = $this->isTestRun ? 'Dry run' : 'Real run';

		$this->persistenceManager = $this->objectManager->get( 'TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager' );
		$this->persistenceManager->persistAll();
	}

	private function endRun() {
		$this->importRun->setRunEndTime( new \DateTime() );
		$startEndDiff						 = $this->importRun->getRunEndTime()->diff( $this->importRun->getRunStartTime() );
		$this->log[ 'msg' ][ "Run time" ]	 = $startEndDiff->format( '%s seconds' );
		$this->importRun->setLog( serialize( $this->log[ 'msg' ] ) );
		$this->importRepository->update( $this->importRun );

		$this->persistenceManager->persistAll();

		DebugUtility::debug( $this->getLog() );
		DebugUtility::debug( $this->stats );
	}

	private function initData() {
		//$sheetId								 = "1fIuCcD90YGC_uXeO3gkl6MXhetH1rI5aOrpeUeJrZXo"; // 8k lignes
		//$sheetId								 = "1ihsxv212_Hex5FMiz4kstGKNUtHbtxNFfF77nh6jagc"; // 235 lignes
		//$sheetId								 = "1fIuCcD90YGC_uXeO3gkl6MXhetH1rI5aOrpeUeJrZXo"; // HUGE lignes
		
		//$sheetPage								 = 1;
		//$url	 = 'https://spreadsheets.google.com/feeds/list/' . $sheetId . '/' . $sheetPage . '/public/values?alt=json';
		
		//$url = "typo3conf/ext/ool_lead/Resources/Public/DataSet/moverLeads.txt";
		$url = "typo3conf/ext/ool_lead/Resources/Public/DataSet/leadMovers-HUGE.txt";
		
		$control								 = [
			'url'		 => $url,
			'sheet'		 => array_filter( json_decode( file_get_contents( $url ), true ) ),
			'fetchTime'	 => (new \DateTime() )->diff( $this->importRun->getRunStartTime() ),
		];
		$this->log[ 'msg' ][ 'JSON Feed Url' ]	 = $url;
		$this->log[ 'msg' ][ 'File load time' ]	 = $control[ 'fetchTime' ]->format( '%s seconds' );

		return $control;
	}

	/**
	 * action import
	 * 
	 * @return void
	 */
	public function importAction() {
		$this->initRun();
		$objectTypes = [ 'endUser', 'leadMover', 'lead' ];
		$maps		 = $this->getMaps();
		$keys		 = $this->getKeys();

		$control = $this->initData();
		$max	 = 1000;
		$start	 = 1;

		$i = $start; $count = $i;
		foreach ( $control[ 'sheet' ][ 'feed' ][ 'entry' ] as $line ) {
			if( !$line ){
				$this->log[ 'msg' ][ 'Completed' ] = "Datasource had been completelly harvested";
				$this->endRun();
				return true;
			}
			
			if ( $i > $max ) {
				$this->log[ 'msg' ][ $this::getTs() ] = "Imported " . ($max) . " records";
				$this->endRun();
				return true;
			}

			$operation = $this->checkForRecordExistence( $keys, $line );
			if( "skip" === $operation ){
				$this->stats[ 'skipped' ]++;
				$count++;
				continue;
			}

			$objects = $this->initNewObjects();

			// process every field of the line
			foreach ( $line as $key => $value ) {
				// remove google sheet prefix
				$fieldNameSrc = str_replace( "gsx\$", "", $key );

				foreach ( $objectTypes as $obj ) {
					$this->setRegularField( $objects[ $obj ], $fieldNameSrc, $maps[ $obj ], $value[ '$t' ] );
				}

				if ( FALSE === $this->isTestRun ) {
					$objects[ 'lead' ]->setEndUser( $objects[ 'endUser' ] );
					$objects[ 'lead' ]->setLeadMover( $objects[ 'leadMover' ] );
					$this->leadRepository->add( $objects[ 'lead' ] );
				}
			}
			$i++;$count++;
		}
	}

	
	/**
	 * 
	 * @param type $keys
	 * @param type $line
	 * @return string insert | skip | update
	 */
	public function checkForRecordExistence( $keys, $line ) {
		$return = 'insert';
		foreach ( $keys as $modelKey=>$model ) {

			foreach ( $model as $fieldKey => $fieldValue ) {
				$gsxKey = "gsx$" . $fieldKey;
				
				if ( array_key_exists( $gsxKey, $line ) ) {
					$repo = null;
					
					switch ( $modelKey ) {
						case "lead":
							$repo = $this->leadRepository;
							$return = "skip";
							break;
						case "endUser":
							$repo = $this->endUserRepository;
							$return = "update";
							break;
					}
					
					$method = "findOneBy" . GeneralUtility::underscoredToUpperCamelCase( $fieldValue );
					$querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
					$querySettings->setRespectStoragePage(FALSE);
					$repo->setDefaultQuerySettings($querySettings);
					$match = $repo->$method( $line[$gsxKey]['$t'] );
					//die( $method );
					if( $match ){
						return $return;
					}
				}
			}
		}
//		DebugUtility::debug( $keys );
//		DebugUtility::debug( $line );

		//array_key_exists( $fieldNameSrc, $map )
//		in_array($keys, $haystack)
	}

	/**
	 * Execute regular mapping from datasource to extbase object
	 * 
	 * @param \TYPO3\CMS\Extbase\DomainObject\AbstractEntity $targetObj : $newLead | $newEndUser
	 * @param string $fieldNameSrc the name of the field in the datasource
	 * @param array $mapTarget two lvl array of mapped fields in the target object : type => field
	 * @param string $value datasource field value to set if there is a match
	 */
	public function setRegularField(
	\TYPO3\CMS\Extbase\DomainObject\AbstractEntity &$targetObj, $fieldNameSrc, $mapTarget, $value
	) {
		foreach ( $mapTarget as $fieldType => $map ) {
			if ( array_key_exists( $fieldNameSrc, $map ) ) {

				// Validate that there is a map for this field
				$property = GeneralUtility::underscoredToUpperCamelCase( $map[ $fieldNameSrc ] );

				// concat setter prefix. ex. end_user TO EndUser
				$func = "set" . $property;

				// set values depending on field type : text / date / processed
				switch ( $fieldType ) {
					case "date":
						$targetObj->{$func}( new \DateTime( $value ) );
						break;
					case "processed":
						$this->setIrregularField( $targetObj, $fieldNameSrc, $map, $value );
						break;
					default:
						$targetObj->{$func}( trim( $value ) );
						break;
				}
			}
		}
	}

	/**
	 * ? Move to model endUser ?
	 * 
	 * Sets firstName and lastName of the referenced object.
	 * Split and trim a first and last name string, split on white spaces
	 * 
	 * @param \OolongMedia\OolLead\Domain\Model\EndUser $newEndUser
	 * @param string $firstAndLastNames
	 * @return void
	 */
	public function setFirstAndLastNames( \OolongMedia\OolLead\Domain\Model\EndUser &$newEndUser, $firstAndLastNames ) {
		$arr	 = GeneralUtility::trimExplode( $delim	 = ' ', $firstAndLastNames, true, 2 );
		$newEndUser->setFirstName( ucfirst( $arr[ 0 ] ) );
		$newEndUser->setLastName( ucfirst( $arr[ 1 ] ) );
	}

	/**
	 * Execute mapping that requires extra processing from datasource to extbase object
	 * 
	 * @param \TYPO3\CMS\Extbase\DomainObject\AbstractEntity $targetObj : $newLead | $newEndUser
	 * @param string $fieldNameSrc the name of the field in the datasource
	 * @param array $mapTarget two lvl array of mapped fields in the target object : type => field
	 * @param string $value datasource field value to set if there is a match
	 */
	public function setIrregularField(
	\TYPO3\CMS\Extbase\DomainObject\AbstractEntity &$targetObj, $fieldNameSrc, $mapTarget, $value
	) {
		foreach ( $mapTarget as $fieldType => $map ) {
			if ( array_key_exists( $fieldNameSrc, $mapTarget ) ) {
				$p		 = GeneralUtility::underscoredToUpperCamelCase( $mapTarget[ $fieldNameSrc ] );
				$func	 = "set" . $p;
				$this->{$func}( $targetObj, $value );
			}
		}
	}

	/* 	 
	 * KEYS
	 * @return array
	 */

	public function getKeys() {
		return $keys = [
			'lead'		 => [ 'id' => 'submission_id', ],
			//'endUser'	 => [ 'courriel' => 'email' ] // TODO
		];
	}

	/* 	 
	 * MAPS
	 * @return array
	 */

	public function getMaps() {
		return $maps = [
			'endUser'	 => [
				'text'		 => [
					'courriel'	 => 'email',
					'téléphone'	 => 'phone'
				],
				// Custom processed properties
				'processed'	 => [
					'nomcomplet' => 'first and last names'
				],
			],
			'lead'		 => [
				"text"	 => [
					'id'		 => 'submission_id',
					'courriel'			 => 'email_used',
				//	'urlsource'			 => 'url_source',
					'ipaddress'	 => 'user_ip'
				],
				"date"	 => [
					'entrydate' => 'date'
				]
			],
			'leadMover'	 => [
				"text"	 => [
					'adressededépart'			 => 'address_from0',
					//'adressededépartadresseligne1'		 => 'address_from1',
					'adressededestination'		 => 'address_to0',
					//'adressededestinationadresseligne1'	 => 'address_to1'
				],
				"date"	 => [
					'déménagementprévule' => 'moving_date'
				]
			],
		];
	}

	/*
	 * HELPERS
	 */

	/**
	 * 
	 * @param type $dateTime
	 */
	public static function getTs( \DateTime $dateTime = null ) {
		$d = new \DateTime();
		return is_null( $dateTime ) ? $d->getTimestamp() : $dateTime->getTimestamp();
	}

}
