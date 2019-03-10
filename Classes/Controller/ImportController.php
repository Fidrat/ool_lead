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
	 * isVerbose
	 * 
	 * @var boolean 
	 */
	//private $isVerbose = false;

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
	private $log = [ "msg"=>[] ];

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
	 * action import
	 * 
	 * @return void
	 */
	public function importAction() {
		$importRun = new \OolongMedia\OolLead\Domain\Model\Import();
		$persistenceManager	 = $this->objectManager->get( 'TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager' );
		$importRun->setRunStartTime( new \DateTime() );
		$this->log['msg'][$this::getTs( $importRun->getRunStartTime() )] = 'Import Action starting' . ($this->isTestRun ? ' - dry run' : ' - real run');

		// Maps [ type1 => [field1, field2], type2 => [field1, field2] ]
		$fieldMapUser		 = [
			'text' => [
				'courriel'	 => 'email',
				'téléphone'	 => 'phone'
			]
		];
		$fieldMapLead		 = [
			"text"	 => [
				'soumissionid'		 => 'submission_id',
				'courriel'			 => 'email_used',
				'urlsource'			 => 'url_source',
				'ipdelutilisateur'	 => 'user_ip'
			],
			"date"	 => [
				'datedelentrée' => 'date'
			]
		];
		$fieldMapLeadMover	 = [
			"text"	 => [
				'adressededépartadresse'			 => 'address_from0',
				'adressededépartadresseligne1'		 => 'address_from1',
				'adressededestinationadresse'		 => 'address_to0',
				'adressededestinationadresseligne1'	 => 'address_to1'
			],
			"date"	 => [
				'déménagementprévule' => 'moving_date'
			]
		];

		// Custom processed properties
		$processedFieldMapUser = [
			'nomcomplet' => 'first and last names'
		];
		
		$sheetId	 = "1ihsxv212_Hex5FMiz4kstGKNUtHbtxNFfF77nh6jagc";
		$sheetPage	 = 1;
		//$url	 = 'https://spreadsheets.google.com/feeds/list/' . $sheetId . '/' . $sheetPage . '/public/values?alt=json';

		$url	 = "typo3conf/ext/ool_lead/Resources/Public/DataSet/moverLeads.txt";
		$this->log['msg']['JSON Feed Url'] = $url;
		$sheet	 = array_filter(json_decode( file_get_contents(  $url  ), true ));
		$fetchTime = (new \DateTime())->diff( $importRun->getRunStartTime() );
		$this->log['msg']['JSON Feed load time'] = $fetchTime->format('%s seconds');
		$max	 = 5;
		$start	 = 1;
		$i		 = $start;
	
		foreach ( $sheet[ 'feed' ][ 'entry' ] as $line ) {
			if ( $i > $max ) {
				$importRun->setRunEndTime( new \DateTime() );
				$this->log['msg'][$this::getTs()] =  "Imported records from " . $start . " to " . $max;
				$this->log['msg']["Run time"] =  $importRun->getRunEndTime()->diff( $importRun->getRunStartTime() )->format( '%s seconds' );

				DebugUtility::debug($this->log);
				return true;
				break;
			}
			
			$newLead		 = new \OolongMedia\OolLead\Domain\Model\Lead();
			$newEndUser		 = new \OolongMedia\OolLead\Domain\Model\EndUser();
			$newLeadMover	 = new \OolongMedia\OolLead\Domain\Model\LeadMover();
			
			// process every field of the line
			foreach ( $line as $key => $value ) {
				$fieldNameSrc = str_replace( "gsx\$", "", $key );
				$this->setRegularField( $newEndUser, $fieldNameSrc, $fieldMapUser, $value[ '$t' ] );
				$this->setIrregularField( $newEndUser, $fieldNameSrc, $processedFieldMapUser, $value[ '$t' ] );
				
				$this->setRegularField( $newLeadMover, $fieldNameSrc, $fieldMapLeadMover, $value[ '$t' ] );
				$this->setRegularField( $newLead, $fieldNameSrc, $fieldMapLead, $value[ '$t' ] );
				
				if( FALSE === $this->isTestRun ){
					$newLead->setEndUser( $newEndUser );
					$newLead->setLeadMover( $newLeadMover );
					$this->leadRepository->add( $newLead );
					$this->isTestRun ? '' : $persistenceManager->persistAll();
				}
			}
			$i++;
		}
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

				// process value by type : text / date
				switch ( $fieldType ) {
					case "date":
						$value	 = new \DateTime( $value );
						break;
					case "default":
						$value	 = trim( $value );
						break;
				}

				// set value to property
				$targetObj->{$func}( $value );
			}
		}
	}

	/**
	 * ? Move to model endUser ?
	 * 
	 * Sets firstName and lastName of the referenced object.
	 * Split and trim a first and last name string, split on white spaces
	 * IMPORT UTILITY : MOVE TO OWN CLASS (STATIC)
	 * 
	 * @param \OolongMedia\OolLead\Domain\Model\EndUser $newEndUser
	 * @param type $firstAndLastNames
	 * @return void
	 */
	public function setFirstAndLastNames( \OolongMedia\OolLead\Domain\Model\EndUser &$newEndUser, $firstAndLastNames ) {
		$arr				 = GeneralUtility::trimExplode( $delim				 = ' ', $string				 = $firstAndLastNames, $removeEmptyValues	 = true, $limit				 = 2 );
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
	
	
	/*********
	 * HELPERS
	 */
	
	/**
	 * 
	 * @param type $dateTime
	 */
	public static function getTs(\DateTime $dateTime=null){
		$d = new \DateTime();
		return is_null($dateTime) ?  $d->getTimestamp() : $dateTime->getTimestamp();
	}
}
