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
    public function getClientSpecificReturnsInitialValueForLeadDemenageur()
    {
        self::assertEquals(
            null,
            $this->subject->getClientSpecific()
        );
    }

    /**
     * @test
     */
    public function setClientSpecificForLeadDemenageurSetsClientSpecific()
    {
        $clientSpecificFixture = new \OolongMedia\OolLead\Domain\Model\LeadDemenageur();
        $this->subject->setClientSpecific($clientSpecificFixture);

        self::assertAttributeEquals(
            $clientSpecificFixture,
            'clientSpecific',
            $this->subject
        );
    }
}
