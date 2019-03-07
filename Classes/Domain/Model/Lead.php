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
     * soumissionid
     * 
     * @var string
     */
    protected $soumissionid = '';

    /**
     * endUser
     * 
     * @var \OolongMedia\OolLead\Domain\Model\EndUser
     */
    protected $endUser = null;

    /**
     * type
     * 
     * @var
     */
    protected $type = null;

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
     * Returns the soumissionid
     * 
     * @return string $soumissionid
     */
    public function getSoumissionid()
    {
        return $this->soumissionid;
    }

    /**
     * Sets the soumissionid
     * 
     * @param string $soumissionid
     * @return void
     */
    public function setSoumissionid($soumissionid)
    {
        $this->soumissionid = $soumissionid;
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
     * Returns the type
     * 
     * @return $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the type
     * 
     * @param string $type
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
    }
}
