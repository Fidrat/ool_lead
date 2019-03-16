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
 * GfImport
 */
class GfImport extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * log
     * 
     * @var string
     */
    protected $log = '';

    /**
     * report
     * 
     * @var string
     */
    protected $report = '';

    /**
     * error
     * 
     * @var string
     */
    protected $error = '';

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
     * Returns the report
     * 
     * @return string $report
     */
    public function getReport()
    {
        return $this->report;
    }

    /**
     * Sets the report
     * 
     * @param string $report
     * @return void
     */
    public function setReport($report)
    {
        $this->report = $report;
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
}
