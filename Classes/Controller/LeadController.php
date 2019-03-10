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
     * leadMoverRepository
     * 
     * @var \OolongMedia\OolLead\Domain\Repository\LeadMoverRepository
     * @inject
     */
    protected $leadMoverRepository = null;

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

    /**
     * action import
     * 
     * @return void
     */
    public function importAction()
    {
    }
}
