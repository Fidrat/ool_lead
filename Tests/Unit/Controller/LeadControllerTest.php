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
}
