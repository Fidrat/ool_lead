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
class ImportController extends \OolongMedia\OolLead\Controller\LeadController{

	/**
	 * action import
	 * TODO : move this logic in another Controller / Task
	 * HELPER: IMPORTER CLASS
	 * 
	 * @return void
	 */
	public function importAction() {
		
		DebugUtility::debug(new \OolongMedia\OolLead\Domain\Model\EndUser() );
		die;
		
		// is Verbose ? prints status to screen if true
		//$v = true;
		$persistenceManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
		
		$startTime = date("Y-m-d H:i:s");
		
		// Maps [ type1 => [field1, field2], type2 => [field1, field2] ]
		$fieldMapUser			 = [
			'text' => [
				'courriel'	 => 'email',
				'téléphone'	 => 'phone'
				]
		];
		$fieldMapLead = [ 
			"text" => [
				'soumissionid'		 => 'submission_id',
				'courriel'			 => 'email_used',
				'urlsource'			 => 'url_source',
				'ipdelutilisateur'	 => 'user_ip',
			],
			"date" => [
				'datedelentrée'		 => 'date',
			]
		];
		$fieldMapLeadMover = [ 
			"text" => [
				'adressededépartadresse'		 => 'address_from0',
				'adressededépartadresseligne1'		 => 'address_from1',
				'adressededestinationadresse'		 => 'address_to0',
				'adressededestinationadresseligne1'		 => 'address_to1',
			],
			"date" => [
				'déménagementprévule'		 => 'moving_date',
			]
		];
		
		// Custom processed properties
		$processedFieldMapUser	 = [
			'nomcomplet' => 'first and last names'
		];
		
		if ( $v ) {
			print "Importing <br>";
		}
		$sheetId	 = "1ihsxv212_Hex5FMiz4kstGKNUtHbtxNFfF77nh6jagc";
		$sheetPage	 = 1;

		//Google Sheet JSON Feed Url
		$url	 = 'https://spreadsheets.google.com/feeds/list/' . $sheetId . '/' . $sheetPage . '/public/values?alt=json';
		$sheet	 = json_decode( file_get_contents( $url ), true );
		$max	 = 25;
		$start	 = 25;//0;
		$i		 = $start;
		
		foreach ( $sheet[ 'feed' ][ 'entry' ] as $line ) {
			$newLead	 = new \OolongMedia\OolLead\Domain\Model\Lead();
			$newEndUser	 = new \OolongMedia\OolLead\Domain\Model\EndUser();
			$newLeadMover	 = new \OolongMedia\OolLead\Domain\Model\LeadMover();
			foreach ( $line as $key => $value ) {
				
				$fieldNameSrc = str_replace( "gsx\$", "", $key );
				if ( $v ) {
					print $fieldNameSrc . " : " . $value[ '$t' ] . "<br>";
				}
				
				// TODO centralize			

//				$this->importEndUserFieldsToDb($newEndUser, $fieldNameSrc, $fieldMapUser, $value[ '$t' ], $i);
				$this->setRegularField( $newEndUser, $fieldNameSrc, $fieldMapUser, $value[ '$t' ] );
				if ( array_key_exists( $fieldNameSrc, $processedFieldMapUser ) ) {
					$p		 = GeneralUtility::underscoredToUpperCamelCase( $processedFieldMapUser[ $fieldNameSrc ] );
					$func	 = "set" . $p;
					$this->{$func}( $newEndUser, $value[ '$t' ] );
				}
				$this->endUserRepository->add($newEndUser);
				
				
				
				$this->setRegularField( $newLeadMover, $fieldNameSrc, $fieldMapLeadMover, $value[ '$t' ] );
				$this->leadMoverRepository->add($newLeadMover);
				$persistenceManager->persistAll();
				
				$this->setRegularField( $newLead, $fieldNameSrc, $fieldMapLead, $value[ '$t' ] );
				$newLead->setEndUser($newEndUser);
				$newLead->setLeadMover($newLeadMover);
				$this->leadRepository->add($newLead);
				$persistenceManager->persistAll();
			}
			if ( $i >= ($start + $max) ) {
//				DebugUtility::debug( $newEndUser );
//				DebugUtility::debug( $newLead );
				die("Imported records " . ($max-$start) . " from " . $start . " to " . $i . "<br> Started at: " . $startTime . "<br>finished at: " . date("Y-m-d H:i:s") );
				break;
			}
			if ( $v ) {
				print "<hr>";
			}
		}
	}

	/**
	 * 
	 * @param \OolongMedia\OolLead\Controller\OolongMedia\OolLead\Domain\Model\EndUser $newEndUser
	 * @param string $fieldNameSrc
	 * @param array $fieldMapUser
	 * @param mixed $value
	 * @param int $start offset
	 * @param int $max top
	 */
	public function importEndUserFieldsToDb(OolongMedia\OolLead\Domain\Model\EndUser $newEndUser, $fieldNameSrc, $fieldMapUser, $value, $i){
		
	}
	
	/**
	 * Execute regular mapping from datasource to extbase object
	 * 
	 * @param \TYPO3\CMS\Extbase\DomainObject\AbstractEntity $targetObj : $newLead | $newEndUser
	 * @param string $fieldNameSrc the name of the field in the datasource
	 * @param array $mapTarget two lvl array of mapped fields in the target object : type => field
	 * @param string $value datasource field value to set if there is a match
	 */
	public function setRegularField( \TYPO3\CMS\Extbase\DomainObject\AbstractEntity &$targetObj, $fieldNameSrc, $mapTarget,
								  $value ) {
		foreach($mapTarget as $fieldType => $map){
			if ( array_key_exists( $fieldNameSrc, $map ) ) {

				// Validate that there is a map for this field
				$property = GeneralUtility::underscoredToUpperCamelCase( $map[ $fieldNameSrc ] );

				// ex. end_user TO EndUser
				$func = "set" . $property;

				// concat setter prefix
				try {
					// process value by type : text / date
					switch($fieldType){
						case "date" :
							$value = new \DateTime( $value );
							break;
						case "default" :
							$value = trim($value);
							break;
					}
					
					// set value to property
					$targetObj->{$func}( $value );

				} catch ( Exception $ex ) {

					// DEV : Cowboy error management
					print_r( $ex );
					die;
				}
			}
		}
	}

	/**
	 * Sets firstName and lastName of the referenced object.
	 * Split and trim a first and last name string, split on white spaces
	 * IMPORT UTILITY : MOVE TO OWN CLASS (STATIC)
	 * 
	 * @param \OolongMedia\OolLead\Domain\Model\EndUser $newEndUser
	 * @param type $firstAndLastNames
	 * @return void
	 */
	public function setFirstAndLastNames( \OolongMedia\OolLead\Domain\Model\EndUser &$newEndUser, $firstAndLastNames ) {
		$arr				 = GeneralUtility::trimExplode(
		$delim				 = ' ', $string				 = $firstAndLastNames, $removeEmptyValues	 = true, $limit				 = 2
		);
		$newEndUser->setFirstName( ucfirst( $arr[ 0 ] ) );
		$newEndUser->setLastName( ucfirst( $arr[ 1 ] ) );
	}

}
