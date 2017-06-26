<?php

namespace Dkd\T3ciparadise\Tests\Functional\Domain\Repository;

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

use Dkd\T3ciparadise\Domain\Repository\PageRepository;
use Dkd\T3ciparadise\Tests\Functional\FunctionalTest;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Object\ObjectManager;

class PageRepositoryTest extends FunctionalTest
{

    /**
     * @var PageRepository
     */
    protected $pageRepository;

    /**
     * @var array
     */
    protected $testExtensionsToLoad = ['typo3conf/ext/t3ciparadise'];

    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $this->fakeTableMappingToPages();

        $this->pageRepository = $this->objectManager->get(PageRepository::class);
    }

    /**
     * @test
     */
    public function canFindAllRootPages()
    {
        $this->importDataSetFromFixture('can_find_all_root_pages.xml');
        $rootPages = $this->pageRepository->findAllRootPages();
        $this->assertCount(1, $rootPages, 'Unexpected amount of root pages');
    }

    /**
     * This method is used to fake the object mapping of the Page model to the pages table.
     * This is usually configured with typoscript.
     *
     * @return void
     */
    protected function fakeTableMappingToPages()
    {
        /** @var ConfigurationManager $configurationManger */
        $configurationManger = $this->objectManager->get(ConfigurationManager::class);
        $configuration = $configurationManger->getConfiguration(ConfigurationManager::CONFIGURATION_TYPE_FRAMEWORK);
        $configuration['persistence']['classes']['Dkd\T3ciparadise\Domain\Model\Page']['mapping']['tableName'] = 'pages';
        $configurationManger->setConfiguration($configuration);
    }
}