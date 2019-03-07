<?php
namespace OolongMedia\OolLead\Domain\Model;


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
 * LeadType
 */
class LeadType extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * lead
     * 
     * @var \OolongMedia\OolLead\Domain\Model\Lead
     */
    protected $lead = null;

    /**
     * clientSpecific
     * 
     * @var \OolongMedia\OolLead\Domain\Model\LeadDemenageur
     */
    protected $clientSpecific = null;

    /**
     * Returns the lead
     * 
     * @return \OolongMedia\OolLead\Domain\Model\Lead $lead
     */
    public function getLead()
    {
        return $this->lead;
    }

    /**
     * Sets the lead
     * 
     * @param \OolongMedia\OolLead\Domain\Model\Lead $lead
     * @return void
     */
    public function setLead(\OolongMedia\OolLead\Domain\Model\Lead $lead)
    {
        $this->lead = $lead;
    }

    /**
     * Returns the clientSpecific
     * 
     * @return \OolongMedia\OolLead\Domain\Model\LeadDemenageur $clientSpecific
     */
    public function getClientSpecific()
    {
        return $this->clientSpecific;
    }

    /**
     * Sets the clientSpecific
     * 
     * @param \OolongMedia\OolLead\Domain\Model\LeadDemenageur $clientSpecific
     * @return void
     */
    public function setClientSpecific(\OolongMedia\OolLead\Domain\Model\LeadDemenageur $clientSpecific)
    {
        $this->clientSpecific = $clientSpecific;
    }
}
