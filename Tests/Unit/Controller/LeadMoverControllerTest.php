<?php
namespace OolongMedia\OolLead\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Fahri Tardif <f.tardif.b@gmail.com>
 */
class LeadMoverControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \OolongMedia\OolLead\Controller\LeadMoverController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\OolongMedia\OolLead\Controller\LeadMoverController::class)
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
    public function listActionFetchesAllLeadMoversFromRepositoryAndAssignsThemToView()
    {

        $allLeadMovers = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $leadMoverRepository = $this->getMockBuilder(\OolongMedia\OolLead\Domain\Repository\LeadMoverRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $leadMoverRepository->expects(self::once())->method('findAll')->will(self::returnValue($allLeadMovers));
        $this->inject($this->subject, 'leadMoverRepository', $leadMoverRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('leadMovers', $allLeadMovers);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenLeadMoverToView()
    {
        $leadMover = new \OolongMedia\OolLead\Domain\Model\LeadMover();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('leadMover', $leadMover);

        $this->subject->showAction($leadMover);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenLeadMoverToLeadMoverRepository()
    {
        $leadMover = new \OolongMedia\OolLead\Domain\Model\LeadMover();

        $leadMoverRepository = $this->getMockBuilder(\OolongMedia\OolLead\Domain\Repository\LeadMoverRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $leadMoverRepository->expects(self::once())->method('add')->with($leadMover);
        $this->inject($this->subject, 'leadMoverRepository', $leadMoverRepository);

        $this->subject->createAction($leadMover);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenLeadMoverToView()
    {
        $leadMover = new \OolongMedia\OolLead\Domain\Model\LeadMover();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('leadMover', $leadMover);

        $this->subject->editAction($leadMover);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenLeadMoverInLeadMoverRepository()
    {
        $leadMover = new \OolongMedia\OolLead\Domain\Model\LeadMover();

        $leadMoverRepository = $this->getMockBuilder(\OolongMedia\OolLead\Domain\Repository\LeadMoverRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $leadMoverRepository->expects(self::once())->method('update')->with($leadMover);
        $this->inject($this->subject, 'leadMoverRepository', $leadMoverRepository);

        $this->subject->updateAction($leadMover);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenLeadMoverFromLeadMoverRepository()
    {
        $leadMover = new \OolongMedia\OolLead\Domain\Model\LeadMover();

        $leadMoverRepository = $this->getMockBuilder(\OolongMedia\OolLead\Domain\Repository\LeadMoverRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $leadMoverRepository->expects(self::once())->method('remove')->with($leadMover);
        $this->inject($this->subject, 'leadMoverRepository', $leadMoverRepository);

        $this->subject->deleteAction($leadMover);
    }
}
