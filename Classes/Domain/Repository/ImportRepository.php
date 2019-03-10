<?php
namespace OolongMedia\OolLead\Domain\Repository;


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
 * The repository for Imports
 */
class ImportRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
	public function initializeObject() {
		//die('ImportRepository');
	}
	
	public function add($model) {
		parent::add($model);
	}
	
	
	
}
