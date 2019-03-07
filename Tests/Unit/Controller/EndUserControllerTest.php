<?php
namespace OolongMedia\OolLead\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Fahri Tardif <f.tardif.b@gmail.com>
 */
class EndUserControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \OolongMedia\OolLead\Controller\EndUserController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\OolongMedia\OolLead\Controller\EndUserController::class)
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
    public function listActionFetchesAllEndUsersFromRepositoryAndAssignsThemToView()
    {

        $allEndUsers = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $endUserRepository = $this->getMockBuilder(\OolongMedia\OolLead\Domain\Repository\EndUserRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $endUserRepository->expects(self::once())->method('findAll')->will(self::returnValue($allEndUsers));
        $this->inject($this->subject, 'endUserRepository', $endUserRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('endUsers', $allEndUsers);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenEndUserToView()
    {
        $endUser = new \OolongMedia\OolLead\Domain\Model\EndUser();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('endUser', $endUser);

        $this->subject->showAction($endUser);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenEndUserToEndUserRepository()
    {
        $endUser = new \OolongMedia\OolLead\Domain\Model\EndUser();

        $endUserRepository = $this->getMockBuilder(\OolongMedia\OolLead\Domain\Repository\EndUserRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $endUserRepository->expects(self::once())->method('add')->with($endUser);
        $this->inject($this->subject, 'endUserRepository', $endUserRepository);

        $this->subject->createAction($endUser);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenEndUserToView()
    {
        $endUser = new \OolongMedia\OolLead\Domain\Model\EndUser();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('endUser', $endUser);

        $this->subject->editAction($endUser);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenEndUserInEndUserRepository()
    {
        $endUser = new \OolongMedia\OolLead\Domain\Model\EndUser();

        $endUserRepository = $this->getMockBuilder(\OolongMedia\OolLead\Domain\Repository\EndUserRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $endUserRepository->expects(self::once())->method('update')->with($endUser);
        $this->inject($this->subject, 'endUserRepository', $endUserRepository);

        $this->subject->updateAction($endUser);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenEndUserFromEndUserRepository()
    {
        $endUser = new \OolongMedia\OolLead\Domain\Model\EndUser();

        $endUserRepository = $this->getMockBuilder(\OolongMedia\OolLead\Domain\Repository\EndUserRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $endUserRepository->expects(self::once())->method('remove')->with($endUser);
        $this->inject($this->subject, 'endUserRepository', $endUserRepository);

        $this->subject->deleteAction($endUser);
    }
}
