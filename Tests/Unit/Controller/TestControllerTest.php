<?php

namespace Dkd\T3ciparadise\Tests\Unit\Controller;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use Dkd\T3ciparadise\Controller\TestController;
use Dkd\T3ciparadise\Domain\Model\Page;
use Dkd\T3ciparadise\Domain\Repository\PageRepository;
use Dkd\T3ciparadise\Tests\Unit\UnitTest;
use TYPO3\CMS\Fluid\View\TemplateView;

class TestControllerTest extends UnitTest
{

    /**
     * @test
     */
    public function canAssignRootPagesToView()
    {
        $viewMock = $this->getDumbMock(TemplateView::class);
        $pageRepositoryMock = $this->getDumbMock(PageRepository::class);

        $fakePage = new Page();
        $fakeRootPages = [$fakePage];

        $pageRepositoryMock->expects($this->once())->method('findAllRootPages')->will($this->returnValue($fakeRootPages));

        $viewMock->expects($this->exactly(1))->method('assign')->with('rootPages', $fakeRootPages);

        $controller = new TestController();
        $controller->setPageRepository($pageRepositoryMock);
        $controller->setView($viewMock);

        $controller->indexAction();
    }

}