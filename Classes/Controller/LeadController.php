<?php
namespace OolongMedia\OolLead\Controller;


/***
 *
 * This file is part of the "lead" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 Fahri Tardif <f.tardif.b@gmail.com>, Oolong média
 *
 ***/
use TYPO3\CMS\Core\Utility\DebugUtility as D;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

/**
 * LeadController
 */
class LeadController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

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
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $leads = $this->leadRepository->findAll();
        $this->view->assign('leads', $leads);
    }

    /**
     * action show
     * 
     * @param \OolongMedia\OolLead\Domain\Model\Lead $lead
     * @return void
     */
    public function showAction(\OolongMedia\OolLead\Domain\Model\Lead $lead)
    {
        $this->view->assign('lead', $lead);
    }

    /**
     * action new
     * 
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * action create
     * 
     * @param \OolongMedia\OolLead\Domain\Model\Lead $newLead
     * @return void
     */
    public function createAction(\OolongMedia\OolLead\Domain\Model\Lead $newLead)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->leadRepository->add($newLead);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \OolongMedia\OolLead\Domain\Model\Lead $lead
     * @ignorevalidation $lead
     * @return void
     */
    public function editAction(\OolongMedia\OolLead\Domain\Model\Lead $lead)
    {
        $this->view->assign('lead', $lead);
    }

    /**
     * action update
     * 
     * @param \OolongMedia\OolLead\Domain\Model\Lead $lead
     * @return void
     */
    public function updateAction(\OolongMedia\OolLead\Domain\Model\Lead $lead)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->leadRepository->update($lead);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \OolongMedia\OolLead\Domain\Model\Lead $lead
     * @return void
     */
    public function deleteAction(\OolongMedia\OolLead\Domain\Model\Lead $lead)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->leadRepository->remove($lead);
        $this->redirect('list');
    }

	/**************************************************/
	
	/**
     * action import
     * 
	 * TODO : move this logic in another Controller / Task
	 * HELPER: IMPORTER CLASS
	 * 
     * @return void
     */
	public function importAction() {
		$v = false; // is Verbose ? prints status to screen if true

		$fieldMapUser = [
			'courriel' => 'email',
			'téléphone' => 'phone',
			];
		
		$processedFieldMapUser = [
			'nomcomplet' => 'first and last names', 
		];
			
		$fieldMapLead = [
			'soumissionid' => 'submissionId', 
			//'date' => 'date',  // manage date
			'courriel' => 'email_used',
			//'urlsource' => 'url_source', // correct mismatch
			//'ipdelutilisateur' => 'ip',// correct mismatch
		];
		
		if($v) print "Importing <br>";

		$sheetId	 = "1ihsxv212_Hex5FMiz4kstGKNUtHbtxNFfF77nh6jagc";
		$sheetPage	 = 1;
		//Google Sheet JSON Feed Url
		$url = 'https://spreadsheets.google.com/feeds/list/' . $sheetId . '/' . $sheetPage . '/public/values?alt=json';
		$sheet = json_decode( file_get_contents( $url ), true );

		$max = 3;
		$i	 = 0;
		
		foreach ( $sheet[ 'feed' ][ 'entry' ] as $line ) {
			
			$newLead = new \OolongMedia\OolLead\Domain\Model\Lead;
			$newEndUser = new \OolongMedia\OolLead\Domain\Model\EndUser;
			
			foreach ( $line as $key => $value ) {
				$fieldNameSrc = str_replace( "gsx$", "", $key );
				
				if($v) print $fieldNameSrc . " : " . $value[ '$t' ] . "<br>";
				
				$this->setRegularField( $newEndUser, $fieldNameSrc, $fieldMapUser, $value[ '$t' ] );

				if( array_key_exists($fieldNameSrc, $processedFieldMapUser) ){
					$p = GeneralUtility::underscoredToUpperCamelCase( $processedFieldMapUser[$fieldNameSrc] );
					$func = "set" . $p;
					$this->$func( $newEndUser, $value[ '$t' ] );
				}
				
				$this->setRegularField( $newLead, $fieldNameSrc, $fieldMapLead, $value[ '$t' ] );

			}

			if ( $i++ > $max ) {
				D::debug($newEndUser);
				D::debug($newLead);
				die();
				break;
			}
			if($v) print "<hr>";
		}
	}
	
	
	/**
	 * Execute regular mapping from datasource to extbase object
	 * 
	 * @param \TYPO3\CMS\Extbase\DomainObject\AbstractEntity $targetObj : $newLead | $newEndUser
	 * @param string $fieldNameSrc the name of the field in the datasource
	 * @param array $mapTarget array of mapped fields in the target object
	 * @param string $value datasource field value to set if there is a match
	 */
	public function setRegularField(\TYPO3\CMS\Extbase\DomainObject\AbstractEntity &$targetObj, $fieldNameSrc, $mapTarget, $value){
		if( array_key_exists($fieldNameSrc, $mapTarget) ){ // Validate that there is a map for this field
			$property = GeneralUtility::underscoredToUpperCamelCase( $mapTarget[$fieldNameSrc] ); // ex. end_user TO EndUser
			$func = "set" . $property; // concat setter prefix
			
			try{
				$targetObj->$func( $value ); // set value to property
			} catch (Exception $ex) { // DEV : Cowboy error management
				print_r($ex);
				die;
			}
			
		}
	}
	
	
	/**
	 * Sets firstName and lastName of the referenced object.
	 * Split and trim a first and last name string, split on white spaces
	 *
	 * IMPORT UTILITY : MOVE TO OWN CLASS (STATIC)
	 * 
	 * @param \OolongMedia\OolLead\Domain\Model\EndUser $newEndUser  
	 * @param type $firstAndLastNames
	 * @return void
	 */
	public function setFirstAndLastNames(\OolongMedia\OolLead\Domain\Model\EndUser &$newEndUser, $firstAndLastNames){
		$arr = GeneralUtility::trimExplode(
			$delim = ' ', 
			$string = $firstAndLastNames, 
			$removeEmptyValues = true, 
			$limit = 2
		);
		$newEndUser->setFirstName( ucfirst( $arr[0] ) );
		$newEndUser->setLastName( ucfirst ( $arr[1] ) );
	}
	
}
