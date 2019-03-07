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
 * EndUser
 */
class EndUser extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * lastName
     * 
     * @var string
     */
    protected $lastName = '';

    /**
     * firstName
     * 
     * @var string
     */
    protected $firstName = '';

    /**
     * submissionId
     * 
     * @var string
     * @validate NotEmpty
     */
    protected $submissionId = '';

    /**
     * email
     * 
     * @var string
     */
    protected $email = '';

    /**
     * phone
     * 
     * @var string
     */
    protected $phone = '';

    /**
     * urlsource
     * 
     * @var string
     */
    protected $urlsource = '';

    /**
     * ip
     * 
     * @var string
     */
    protected $ip = '';

    /**
     * Returns the lastName
     * 
     * @return string $lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Sets the lastName
     * 
     * @param string $lastName
     * @return void
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * Returns the firstName
     * 
     * @return string $firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Sets the firstName
     * 
     * @param string $firstName
     * @return void
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Returns the email
     * 
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the email
     * 
     * @param string $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Returns the phone
     * 
     * @return string $phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Sets the phone
     * 
     * @param string $phone
     * @return void
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Returns the urlsource
     * 
     * @return string $urlsource
     */
    public function getUrlsource()
    {
        return $this->urlsource;
    }

    /**
     * Sets the urlsource
     * 
     * @param string $urlsource
     * @return void
     */
    public function setUrlsource($urlsource)
    {
        $this->urlsource = $urlsource;
    }

    /**
     * Returns the ip
     * 
     * @return string $ip
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Sets the ip
     * 
     * @param string $ip
     * @return void
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * Returns the submissionId
     * 
     * @return string submissionId
     */
    public function getSubmissionId()
    {
        return $this->submissionId;
    }

    /**
     * Sets the submissionId
     * 
     * @param string $submissionId
     * @return void
     */
    public function setSubmissionId($submissionId)
    {
        $this->submissionId = $submissionId;
    }
}
