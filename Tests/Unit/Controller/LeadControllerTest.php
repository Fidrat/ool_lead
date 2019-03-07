<?php
namespace OolongMedia\OolLead\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Fahri Tardif <f.tardif.b@gmail.com>
 */
class LeadControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \OolongMedia\OolLead\Controller\LeadController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\OolongMedia\OolLead\Controller\LeadController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllLeadsFromRepositoryAndAssignsThemToView()
    {

        $allLeads = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $leadRepository = $this->getMockBuilder(\OolongMedia\OolLead\Domain\Repository\LeadRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $leadRepository->expects(self::once())->method('findAll')->will(self::returnValue($allLeads));
        $this->inject($this->subject, 'leadRepository', $leadRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('leads', $allLeads);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenLeadToView()
    {
        $lead = new \OolongMedia\OolLead\Domain\Model\Lead();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('lead', $lead);

        $this->subject->showAction($lead);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenLeadToLeadRepository()
    {
        $lead = new \OolongMedia\OolLead\Domain\Model\Lead();

        $leadRepository = $this->getMockBuilder(\OolongMedia\OolLead\Domain\Repository\LeadRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $leadRepository->expects(self::once())->method('add')->with($lead);
        $this->inject($this->subject, 'leadRepository', $leadRepository);

        $this->subject->createAction($lead);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenLeadToView()
    {
        $lead = new \OolongMedia\OolLead\Domain\Model\Lead();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('lead', $lead);

        $this->subject->editAction($lead);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenLeadInLeadRepository()
    {
        $lead = new \OolongMedia\OolLead\Domain\Model\Lead();

        $leadRepository = $this->getMockBuilder(\OolongMedia\OolLead\Domain\Repository\LeadRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $leadRepository->expects(self::once())->method('update')->with($lead);
        $this->inject($this->subject, 'leadRepository', $leadRepository);

        $this->subject->updateAction($lead);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenLeadFromLeadRepository()
    {
        $lead = new \OolongMedia\OolLead\Domain\Model\Lead();

        $leadRepository = $this->getMockBuilder(\OolongMedia\OolLead\Domain\Repository\LeadRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $leadRepository->expects(self::once())->method('remove')->with($lead);
        $this->inject($this->subject, 'leadRepository', $leadRepository);

        $this->subject->deleteAction($lead);
    }
}
