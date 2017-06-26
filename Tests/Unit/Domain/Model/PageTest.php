<?php

namespace Dkd\T3ciparadise\Tests\Unit\Domain\Model;

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
use Dkd\T3ciparadise\Tests\Unit\UnitTest;

class PageTest extends UnitTest
{

    /**
     * @test
     */
    public function canSetTitle()
    {
        $page = new Page();
        $page->setTitle('testtitle');
        $this->assertSame('testtitle', $page->getTitle(), 'Can not get page title');
    }

}