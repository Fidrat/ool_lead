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
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $leads = $this->leadRepository->findAll();
        $this->view->assign('leads', $leads);
    }
}
