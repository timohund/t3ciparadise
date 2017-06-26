<?php

namespace Dkd\T3ciparadise\Tests\Unit;

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

use Nimut\TestingFramework\TestCase\UnitTestCase;

abstract class UnitTest extends UnitTestCase {

    /**
     * Returns a mock class where every behaviour is mocked, just to full fill
     * the datatype and have the possibility to mock the behaviour.
     *
     * @param string $className
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getDumbMock($className)
    {
        return $this->getMockBuilder($className)->setMethods([])->disableOriginalConstructor()->getMock();
    }
}