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
 * LeadDemenageur
 */
class LeadMover extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * addressFrom0
     * 
     * @var string
     */
    protected $addressFrom0 = '';

    /**
     * addressFrom1
     * 
     * @var string
     */
    protected $addressFrom1 = '';

    /**
     * addressTo0
     * 
     * @var string
     */
    protected $addressTo0 = '';

    /**
     * addressTo1
     * 
     * @var string
     */
    protected $addressTo1 = '';

    /**
     * movingDate
     * 
     * @var \DateTime
     */
    protected $movingDate = null;

    /**
     * Returns the addressFrom0
     * 
     * @return string $addressFrom0
     */
    public function getAddressFrom0()
    {
        return $this->addressFrom0;
    }

    /**
     * Sets the addressFrom0
     * 
     * @param string $addressFrom0
     * @return void
     */
    public function setAddressFrom0($addressFrom0)
    {
        $this->addressFrom0 = $addressFrom0;
    }

    /**
     * Returns the addressFrom1
     * 
     * @return string $addressFrom1
     */
    public function getAddressFrom1()
    {
        return $this->addressFrom1;
    }

    /**
     * Sets the addressFrom1
     * 
     * @param string $addressFrom1
     * @return void
     */
    public function setAddressFrom1($addressFrom1)
    {
        $this->addressFrom1 = $addressFrom1;
    }

    /**
     * Returns the addressTo0
     * 
     * @return string $addressTo0
     */
    public function getAddressTo0()
    {
        return $this->addressTo0;
    }

    /**
     * Sets the addressTo0
     * 
     * @param string $addressTo0
     * @return void
     */
    public function setAddressTo0($addressTo0)
    {
        $this->addressTo0 = $addressTo0;
    }

    /**
     * Returns the addressTo1
     * 
     * @return string $addressTo1
     */
    public function getAddressTo1()
    {
        return $this->addressTo1;
    }

    /**
     * Sets the addressTo1
     * 
     * @param string $addressTo1
     * @return void
     */
    public function setAddressTo1($addressTo1)
    {
        $this->addressTo1 = $addressTo1;
    }

    /**
     * Returns the movingDate
     * 
     * @return \DateTime $movingDate
     */
    public function getMovingDate()
    {
        return $this->movingDate;
    }

    /**
     * Sets the movingDate
     * 
     * @param \DateTime $movingDate
     * @return void
     */
    public function setMovingDate(\DateTime $movingDate)
    {
        $this->movingDate = $movingDate;
    }
}
