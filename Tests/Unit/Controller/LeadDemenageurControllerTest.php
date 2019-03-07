<?php
namespace OolongMedia\OolLead\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Fahri Tardif <f.tardif.b@gmail.com>
 */
class LeadDemenageurControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \OolongMedia\OolLead\Controller\LeadDemenageurController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\OolongMedia\OolLead\Controller\LeadDemenageurController::class)
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
    public function listActionFetchesAllLeadDemenageursFromRepositoryAndAssignsThemToView()
    {

        $allLeadDemenageurs = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $leadDemenageurRepository = $this->getMockBuilder(\OolongMedia\OolLead\Domain\Repository\LeadDemenageurRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $leadDemenageurRepository->expects(self::once())->method('findAll')->will(self::returnValue($allLeadDemenageurs));
        $this->inject($this->subject, 'leadDemenageurRepository', $leadDemenageurRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('leadDemenageurs', $allLeadDemenageurs);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenLeadDemenageurToView()
    {
        $leadDemenageur = new \OolongMedia\OolLead\Domain\Model\LeadDemenageur();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('leadDemenageur', $leadDemenageur);

        $this->subject->showAction($leadDemenageur);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenLeadDemenageurToLeadDemenageurRepository()
    {
        $leadDemenageur = new \OolongMedia\OolLead\Domain\Model\LeadDemenageur();

        $leadDemenageurRepository = $this->getMockBuilder(\OolongMedia\OolLead\Domain\Repository\LeadDemenageurRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $leadDemenageurRepository->expects(self::once())->method('add')->with($leadDemenageur);
        $this->inject($this->subject, 'leadDemenageurRepository', $leadDemenageurRepository);

        $this->subject->createAction($leadDemenageur);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenLeadDemenageurToView()
    {
        $leadDemenageur = new \OolongMedia\OolLead\Domain\Model\LeadDemenageur();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('leadDemenageur', $leadDemenageur);

        $this->subject->editAction($leadDemenageur);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenLeadDemenageurInLeadDemenageurRepository()
    {
        $leadDemenageur = new \OolongMedia\OolLead\Domain\Model\LeadDemenageur();

        $leadDemenageurRepository = $this->getMockBuilder(\OolongMedia\OolLead\Domain\Repository\LeadDemenageurRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $leadDemenageurRepository->expects(self::once())->method('update')->with($leadDemenageur);
        $this->inject($this->subject, 'leadDemenageurRepository', $leadDemenageurRepository);

        $this->subject->updateAction($leadDemenageur);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenLeadDemenageurFromLeadDemenageurRepository()
    {
        $leadDemenageur = new \OolongMedia\OolLead\Domain\Model\LeadDemenageur();

        $leadDemenageurRepository = $this->getMockBuilder(\OolongMedia\OolLead\Domain\Repository\LeadDemenageurRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $leadDemenageurRepository->expects(self::once())->method('remove')->with($leadDemenageur);
        $this->inject($this->subject, 'leadDemenageurRepository', $leadDemenageurRepository);

        $this->subject->deleteAction($leadDemenageur);
    }
}
