<?php

namespace Dkd\T3ciparadise\Tests\Unit\Domain\Repository;

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

use Dkd\T3ciparadise\Domain\Model\Page;
use Dkd\T3ciparadise\Domain\Repository\PageRepository;
use Dkd\T3ciparadise\Tests\Unit\UnitTest;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

class PageRepositoryTest extends UnitTest
{

    /**
     * @var PageRepository
     */
    protected $pageRepositoryMock;

    /**
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->pageRepositoryMock = $this->getMockBuilder(PageRepository::class)->disableOriginalConstructor()->setMethods(['createQuery'])->getMock();
    }

    /**
     * @test
     */
    public function canFindAllRootPages()
    {
            /** @var QueryInterface $queryMock */
        $queryMock = $this->getDumbMock(QueryInterface::class);
        $queryMock->expects($this->once())->method('equals')->with('is_siteroot', 1);

        $fakePage = new Page();
        $fakeResult = [$fakePage];
        $queryMock->expects($this->once())->method('execute')->will($this->returnValue($fakeResult));

        // we use the mocked query during the test
        $this->pageRepositoryMock->expects($this->once())->method('createQuery')->will($this->returnValue($queryMock));
        $result = $this->pageRepositoryMock->findAllRootPages();

        $this->assertSame($fakePage, $result[0], 'Repository did not return expected pages');

    }

}