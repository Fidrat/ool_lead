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
 * GfImportController
 */
class GfImportController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * gfImportRepository
     * 
     * @var \OolongMedia\OolLead\Domain\Repository\GfImportRepository
     * @inject
     */
    protected $gfImportRepository = null;

    /**
     * action importOne
     * 
     * @return void
     */
    public function importOneAction()
    {
    }

    /**
     * action importBatch
     * 
     * @return void
     */
    public function importBatchAction()
    {
    }
}
