<?php
namespace OolongMedia\OolLead\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Fahri Tardif <f.tardif.b@gmail.com>
 */
class LeadTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \OolongMedia\OolLead\Domain\Model\Lead
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \OolongMedia\OolLead\Domain\Model\Lead();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getDateReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getDate()
        );
    }

    /**
     * @test
     */
    public function setDateForDateTimeSetsDate()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setDate($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'date',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getEmailUsedReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getEmailUsed()
        );
    }

    /**
     * @test
     */
    public function setEmailUsedForStringSetsEmailUsed()
    {
        $this->subject->setEmailUsed('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'emailUsed',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getSoumissionidReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getSoumissionid()
        );
    }

    /**
     * @test
     */
    public function setSoumissionidForStringSetsSoumissionid()
    {
        $this->subject->setSoumissionid('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'soumissionid',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getEndUserReturnsInitialValueForEndUser()
    {
        self::assertEquals(
            null,
            $this->subject->getEndUser()
        );
    }

    /**
     * @test
     */
    public function setEndUserForEndUserSetsEndUser()
    {
        $endUserFixture = new \OolongMedia\OolLead\Domain\Model\EndUser();
        $this->subject->setEndUser($endUserFixture);

        self::assertAttributeEquals(
            $endUserFixture,
            'endUser',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTypeReturnsInitialValueFor()
    {
    }

    /**
     * @test
     */
    public function setTypeForSetsType()
    {
    }
}
