<?php
namespace OolongMedia\OolLead\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Fahri Tardif <f.tardif.b@gmail.com>
 */
class GfImportTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \OolongMedia\OolLead\Domain\Model\GfImport
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \OolongMedia\OolLead\Domain\Model\GfImport();
    }

    protected function tearDown()
    {
        parent::tearDown();
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
    public function getReportReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getReport()
        );
    }

    /**
     * @test
     */
    public function setReportForStringSetsReport()
    {
        $this->subject->setReport('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'report',
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
}
