<?php
namespace OolongMedia\OolLead\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Fahri Tardif <f.tardif.b@gmail.com>
 */
class LeadTypeTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \OolongMedia\OolLead\Domain\Model\LeadType
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \OolongMedia\OolLead\Domain\Model\LeadType();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getLeadReturnsInitialValueForLead()
    {
        self::assertEquals(
            null,
            $this->subject->getLead()
        );
    }

    /**
     * @test
     */
    public function setLeadForLeadSetsLead()
    {
        $leadFixture = new \OolongMedia\OolLead\Domain\Model\Lead();
        $this->subject->setLead($leadFixture);

        self::assertAttributeEquals(
            $leadFixture,
            'lead',
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
