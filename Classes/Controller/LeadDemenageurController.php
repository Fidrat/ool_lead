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
 * LeadDemenageurController
 */
class LeadDemenageurController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * leadDemenageurRepository
     * 
     * @var \OolongMedia\OolLead\Domain\Repository\LeadDemenageurRepository
     * @inject
     */
    protected $leadDemenageurRepository = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $leadDemenageurs = $this->leadDemenageurRepository->findAll();
        $this->view->assign('leadDemenageurs', $leadDemenageurs);
    }

    /**
     * action show
     * 
     * @param \OolongMedia\OolLead\Domain\Model\LeadDemenageur $leadDemenageur
     * @return void
     */
    public function showAction(\OolongMedia\OolLead\Domain\Model\LeadDemenageur $leadDemenageur)
    {
        $this->view->assign('leadDemenageur', $leadDemenageur);
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
     * @param \OolongMedia\OolLead\Domain\Model\LeadDemenageur $newLeadDemenageur
     * @return void
     */
    public function createAction(\OolongMedia\OolLead\Domain\Model\LeadDemenageur $newLeadDemenageur)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->leadDemenageurRepository->add($newLeadDemenageur);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \OolongMedia\OolLead\Domain\Model\LeadDemenageur $leadDemenageur
     * @ignorevalidation $leadDemenageur
     * @return void
     */
    public function editAction(\OolongMedia\OolLead\Domain\Model\LeadDemenageur $leadDemenageur)
    {
        $this->view->assign('leadDemenageur', $leadDemenageur);
    }

    /**
     * action update
     * 
     * @param \OolongMedia\OolLead\Domain\Model\LeadDemenageur $leadDemenageur
     * @return void
     */
    public function updateAction(\OolongMedia\OolLead\Domain\Model\LeadDemenageur $leadDemenageur)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->leadDemenageurRepository->update($leadDemenageur);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \OolongMedia\OolLead\Domain\Model\LeadDemenageur $leadDemenageur
     * @return void
     */
    public function deleteAction(\OolongMedia\OolLead\Domain\Model\LeadDemenageur $leadDemenageur)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->leadDemenageurRepository->remove($leadDemenageur);
        $this->redirect('list');
    }
}
