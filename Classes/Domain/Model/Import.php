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
 * Import
 */
class Import extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * runStartTime
     * 
     * @var \DateTime
     */
    protected $runStartTime = null;

    /**
     * runEndTime
     * 
     * @var \DateTime
     */
    protected $runEndTime = null;

    /**
     * finishedOnError
     * 
     * @var bool
     */
    protected $finishedOnError = false;

    /**
     * error
     * 
     * @var string
     */
    protected $error = '';

    /**
     * log
     * 
     * @var string
     */
    protected $log = '';

    /**
     * reportData
     * 
     * @var string
     */
    protected $reportData = '';

    /**
     * Returns the runStartTime
     * 
     * @return \DateTime $runStartTime
     */
    public function getRunStartTime()
    {
        return $this->runStartTime;
    }

    /**
     * Sets the runStartTime
     * 
     * @param \DateTime $runStartTime
     * @return void
     */
    public function setRunStartTime(\DateTime $runStartTime)
    {
        $this->runStartTime = $runStartTime;
    }

    /**
     * Returns the runEndTime
     * 
     * @return \DateTime $runEndTime
     */
    public function getRunEndTime()
    {
        return $this->runEndTime;
    }

    /**
     * Sets the runEndTime
     * 
     * @param \DateTime $runEndTime
     * @return void
     */
    public function setRunEndTime(\DateTime $runEndTime)
    {
        $this->runEndTime = $runEndTime;
    }

    /**
     * Returns the finishedOnError
     * 
     * @return bool $finishedOnError
     */
    public function getFinishedOnError()
    {
        return $this->finishedOnError;
    }

    /**
     * Sets the finishedOnError
     * 
     * @param bool $finishedOnError
     * @return void
     */
    public function setFinishedOnError($finishedOnError)
    {
        $this->finishedOnError = $finishedOnError;
    }

    /**
     * Returns the boolean state of finishedOnError
     * 
     * @return bool
     */
    public function isFinishedOnError()
    {
        return $this->finishedOnError;
    }

    /**
     * Returns the error
     * 
     * @return string $error
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Sets the error
     * 
     * @param string $error
     * @return void
     */
    public function setError($error)
    {
        $this->error = $error;
    }

    /**
     * Returns the log
     * 
     * @return string $log
     */
    public function getLog()
    {
        return $this->log;
    }

    /**
     * Sets the log
     * 
     * @param string $log
     * @return void
     */
    public function setLog($log)
    {
        $this->log = $log;
    }

    /**
     * Returns the reportData
     * 
     * @return string $reportData
     */
    public function getReportData()
    {
        return $this->reportData;
    }

    /**
     * Sets the reportData
     * 
     * @param string $reportData
     * @return void
     */
    public function setReportData($reportData)
    {
        $this->reportData = $reportData;
    }
}
