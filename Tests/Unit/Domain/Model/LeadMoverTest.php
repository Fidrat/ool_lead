<?php
namespace OolongMedia\OolLead\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Fahri Tardif <f.tardif.b@gmail.com>
 */
class LeadMoverTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \OolongMedia\OolLead\Domain\Model\LeadMover
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \OolongMedia\OolLead\Domain\Model\LeadMover();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getAddressFrom0ReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getAddressFrom0()
        );
    }

    /**
     * @test
     */
    public function setAddressFrom0ForStringSetsAddressFrom0()
    {
        $this->subject->setAddressFrom0('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'addressFrom0',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getAddressFrom1ReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getAddressFrom1()
        );
    }

    /**
     * @test
     */
    public function setAddressFrom1ForStringSetsAddressFrom1()
    {
        $this->subject->setAddressFrom1('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'addressFrom1',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getAddressTo0ReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getAddressTo0()
        );
    }

    /**
     * @test
     */
    public function setAddressTo0ForStringSetsAddressTo0()
    {
        $this->subject->setAddressTo0('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'addressTo0',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getAddressTo1ReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getAddressTo1()
        );
    }

    /**
     * @test
     */
    public function setAddressTo1ForStringSetsAddressTo1()
    {
        $this->subject->setAddressTo1('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'addressTo1',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getMovingDateReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getMovingDate()
        );
    }

    /**
     * @test
     */
    public function setMovingDateForDateTimeSetsMovingDate()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setMovingDate($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'movingDate',
            $this->subject
        );
    }
}
