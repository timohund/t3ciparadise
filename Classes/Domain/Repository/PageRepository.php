<?php
namespace Dkd\T3ciparadise\Domain\Repository;

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

use TYPO3\CMS\Extbase\Persistence\Generic\QuerySettingsInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Class PageRepository
 * @package Dkd\T3ciparadise\Domain\Repository
 */
class PageRepository extends Repository
{

    /**
     * Deactivate storage pid check
     *
     * @param QuerySettingsInterface $defaultQuerySettings
     * @return void
     */
    public function injectDefaultQuerySettings(QuerySettingsInterface $defaultQuerySettings)
    {
        $defaultQuerySettings->setRespectStoragePage(false);
        $this->setDefaultQuerySettings($defaultQuerySettings);
    }

    /**
     * @return array
     */
    public function findAllRootPages()
    {
        $query = $this->createQuery();
        $query->matching($query->equals('is_siteroot', 1));
        return $query->execute();
    }
}
