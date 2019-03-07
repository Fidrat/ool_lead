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
     * leadMover
     * 
     * @var \OolongMedia\OolLead\Domain\Model\LeadMover
     */
    protected $leadMover = null;

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
     * Returns the leadMover
     * 
     * @return \OolongMedia\OolLead\Domain\Model\LeadMover leadMover
     */
    public function getLeadMover()
    {
        return $this->leadMover;
    }

    /**
     * Sets the leadMover
     * 
     * @param \OolongMedia\OolLead\Domain\Model\LeadMover $leadMover
     * @return void
     */
    public function setLeadMover(\OolongMedia\OolLead\Domain\Model\LeadMover $leadMover)
    {
        $this->leadMover = $leadMover;
    }
}
