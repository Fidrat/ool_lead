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
 * Lead
 */
class Lead extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * submissionid
     * 
     * @var string
     */
    protected $submissionid = '';

    /**
     * date
     * 
     * @var \DateTime
     */
    protected $date = null;

    /**
     * emailUsed
     * 
     * @var string
     */
    protected $emailUsed = '';

    /**
     * endUser
     * 
     * @var \OolongMedia\OolLead\Domain\Model\EndUser
     */
    protected $endUser = null;

    /**
     * leadMover
     * 
     * @var \OolongMedia\OolLead\Domain\Model\LeadMover
     */
    protected $leadMover = null;

    /**
     * submissionId
     * 
     * @var string
     */
    protected $submissionId = '';

    /**
     * urlSource
     * 
     * @var string
     */
    protected $urlSource = '';

    /**
     * userIp
     * 
     * @var string
     */
    protected $userIp = '';

    /**
     * Returns the date
     * 
     * @return \DateTime $date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Sets the date
     * 
     * @param \DateTime $date
     * @return void
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * Returns the emailUsed
     * 
     * @return string $emailUsed
     */
    public function getEmailUsed()
    {
        return $this->emailUsed;
    }

    /**
     * Sets the emailUsed
     * 
     * @param string $emailUsed
     * @return void
     */
    public function setEmailUsed($emailUsed)
    {
        $this->emailUsed = $emailUsed;
    }

    /**
     * Returns the submissionid
     * 
     * @return string $submissionid
     */
    public function getSubmissionid()
    {
        return $this->submissionid;
    }

    /**
     * Sets the submissionid
     * 
     * @param string $submissionid
     * @return void
     */
    public function setSubmissionid($submissionid)
    {
        $this->submissionid = $submissionid;
    }

    /**
     * Returns the endUser
     * 
     * @return \OolongMedia\OolLead\Domain\Model\EndUser $endUser
     */
    public function getEndUser()
    {
        return $this->endUser;
    }

    /**
     * Sets the endUser
     * 
     * @param \OolongMedia\OolLead\Domain\Model\EndUser $endUser
     * @return void
     */
    public function setEndUser(\OolongMedia\OolLead\Domain\Model\EndUser $endUser)
    {
        $this->endUser = $endUser;
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
     * @param string $leadMover
     * @return void
     */
    public function setLeadMover($leadMover)
    {
        $this->leadMover = $leadMover;
    }

    /**
     * Returns the urlSource
     * 
     * @return string $urlSource
     */
    public function getUrlSource()
    {
        return $this->urlSource;
    }

    /**
     * Sets the urlSource
     * 
     * @param string $urlSource
     * @return void
     */
    public function setUrlSource($urlSource)
    {
        $this->urlSource = $urlSource;
    }

    /**
     * Returns the userIp
     * 
     * @return string $userIp
     */
    public function getUserIp()
    {
        return $this->userIp;
    }

    /**
     * Sets the userIp
     * 
     * @param string $userIp
     * @return void
     */
    public function setUserIp($userIp)
    {
        $this->userIp = $userIp;
    }
}
