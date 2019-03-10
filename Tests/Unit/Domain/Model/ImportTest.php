<?php
namespace OolongMedia\OolLead\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Fahri Tardif <f.tardif.b@gmail.com>
 */
class ImportTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \OolongMedia\OolLead\Domain\Model\Import
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \OolongMedia\OolLead\Domain\Model\Import();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getRunStartTimeReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getRunStartTime()
        );
    }

    /**
     * @test
     */
    public function setRunStartTimeForDateTimeSetsRunStartTime()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setRunStartTime($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'runStartTime',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getRunEndTimeReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getRunEndTime()
        );
    }

    /**
     * @test
     */
    public function setRunEndTimeForDateTimeSetsRunEndTime()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setRunEndTime($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'runEndTime',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getFinishedOnErrorReturnsInitialValueForBool()
    {
        self::assertSame(
            false,
            $this->subject->getFinishedOnError()
        );
    }

    /**
     * @test
     */
    public function setFinishedOnErrorForBoolSetsFinishedOnError()
    {
        $this->subject->setFinishedOnError(true);

        self::assertAttributeEquals(
            true,
            'finishedOnError',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getErrorReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getError()
        );
    }

    /**
     * @test
     */
    public function setErrorForStringSetsError()
    {
        $this->subject->setError('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'error',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLogReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getLog()
        );
    }

    /**
     * @test
     */
    public function setLogForStringSetsLog()
    {
        $this->subject->setLog('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'log',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getReportDataReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getReportData()
        );
    }

    /**
     * @test
     */
    public function setReportDataForStringSetsReportData()
    {
        $this->subject->setReportData('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'reportData',
            $this->subject
        );
    }
}
