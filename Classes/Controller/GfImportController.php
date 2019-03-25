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
 * GfImportController
 */
class GfImportController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

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
	public function importOneAction() {
		$curl = curl_init();
		curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $curl, CURLOPT_SSL_VERIFYHOST, false );

		curl_setopt($curl, CURLOPT_USERPWD, "fari" . ":" . "rmvQsHTt5dOlfSls2NmrM@0C");

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://byebyelesdettes.com/wp-json/gf/v2/entries/119113/?_labels=1&oauth_consumer_key=ck_ef8b04aa08028ddcdac3634b50ebd91098324633&oauth_signature_method=HMAC-SHA1&oauth_timestamp=1552715998&oauth_nonce=lDaTMNHNETZ&oauth_version=1.0&oauth_signature=8o89aTq3g5d1lLlidlJyLm4ffo0=",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_HTTPHEADER => array(
    "Postman-Token: 153b87a0-3e9e-4330-8c7c-5aba934b5ea1",
    "cache-control: no-cache"
  ),
));
		$response	 = curl_exec( $curl );
		$err		 = curl_error( $curl );
		curl_close( $curl );
		if ( $err ) {
			echo "cURL Error #:" . $err;
		} else {
			echo DebugUtility::debug($response);
			die;
		}
	}

	/**
	 * action importBatch
	 * 
	 * @return void
	 */
	public function importBatchAction() {
		
	}

}
