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
/**
 * LeadMoverController
 */
class LeadMoverController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

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
        $leadMovers = $this->leadMoverRepository->findAll();
        $this->view->assign('leadMovers', $leadMovers);
    }

    /**
     * action show
     * 
     * @param \OolongMedia\OolLead\Domain\Model\LeadMover $leadMover
     * @return void
     */
    public function showAction(\OolongMedia\OolLead\Domain\Model\LeadMover $leadMover)
    {
        $this->view->assign('leadMover', $leadMover);
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
     * @param \OolongMedia\OolLead\Domain\Model\LeadMover $newLeadMover
     * @return void
     */
    public function createAction(\OolongMedia\OolLead\Domain\Model\LeadMover $newLeadMover)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->leadMoverRepository->add($newLeadMover);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \OolongMedia\OolLead\Domain\Model\LeadMover $leadMover
     * @ignorevalidation $leadMover
     * @return void
     */
    public function editAction(\OolongMedia\OolLead\Domain\Model\LeadMover $leadMover)
    {
        $this->view->assign('leadMover', $leadMover);
    }

    /**
     * action update
     * 
     * @param \OolongMedia\OolLead\Domain\Model\LeadMover $leadMover
     * @return void
     */
    public function updateAction(\OolongMedia\OolLead\Domain\Model\LeadMover $leadMover)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->leadMoverRepository->update($leadMover);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \OolongMedia\OolLead\Domain\Model\LeadMover $leadMover
     * @return void
     */
    public function deleteAction(\OolongMedia\OolLead\Domain\Model\LeadMover $leadMover)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->leadMoverRepository->remove($leadMover);
        $this->redirect('list');
    }
}
