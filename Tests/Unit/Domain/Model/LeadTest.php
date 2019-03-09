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
    public function getSubmissionIdReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getSubmissionId()
        );
    }

    /**
     * @test
     */
    public function setSubmissionIdForStringSetsSubmissionId()
    {
        $this->subject->setSubmissionId('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'submissionId',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getUrlSourceReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getUrlSource()
        );
    }

    /**
     * @test
     */
    public function setUrlSourceForStringSetsUrlSource()
    {
        $this->subject->setUrlSource('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'urlSource',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getUserIpReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getUserIp()
        );
    }

    /**
     * @test
     */
    public function setUserIpForStringSetsUserIp()
    {
        $this->subject->setUserIp('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'userIp',
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
    public function getLeadMoverReturnsInitialValueForLeadMover()
    {
        self::assertEquals(
            null,
            $this->subject->getLeadMover()
        );
    }

    /**
     * @test
     */
    public function setLeadMoverForLeadMoverSetsLeadMover()
    {
        $leadMoverFixture = new \OolongMedia\OolLead\Domain\Model\LeadMover();
        $this->subject->setLeadMover($leadMoverFixture);

        self::assertAttributeEquals(
            $leadMoverFixture,
            'leadMover',
            $this->subject
        );
    }
}
