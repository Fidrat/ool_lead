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
 * EndUserController
 */
class EndUserController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

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
        $endUsers = $this->endUserRepository->findAll();
        $this->view->assign('endUsers', $endUsers);
    }

    /**
     * action show
     * 
     * @param \OolongMedia\OolLead\Domain\Model\EndUser $endUser
     * @return void
     */
    public function showAction(\OolongMedia\OolLead\Domain\Model\EndUser $endUser)
    {
        $this->view->assign('endUser', $endUser);
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
     * @param \OolongMedia\OolLead\Domain\Model\EndUser $newEndUser
     * @return void
     */
    public function createAction(\OolongMedia\OolLead\Domain\Model\EndUser $newEndUser)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->endUserRepository->add($newEndUser);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \OolongMedia\OolLead\Domain\Model\EndUser $endUser
     * @ignorevalidation $endUser
     * @return void
     */
    public function editAction(\OolongMedia\OolLead\Domain\Model\EndUser $endUser)
    {
        $this->view->assign('endUser', $endUser);
    }

    /**
     * action update
     * 
     * @param \OolongMedia\OolLead\Domain\Model\EndUser $endUser
     * @return void
     */
    public function updateAction(\OolongMedia\OolLead\Domain\Model\EndUser $endUser)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->endUserRepository->update($endUser);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \OolongMedia\OolLead\Domain\Model\EndUser $endUser
     * @return void
     */
    public function deleteAction(\OolongMedia\OolLead\Domain\Model\EndUser $endUser)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->endUserRepository->remove($endUser);
        $this->redirect('list');
    }
}
