<?php
namespace Dkd\T3ciparadise\Controller;

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

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;

/**
 * Class TestController
 * @package Dkd\T3ciparadise\Controllers
 */
class TestController extends ActionController
{

    /**
     * @inject
     * @var \Dkd\T3ciparadise\Domain\Repository\PageRepository
     */
    protected $pageRepository;

    /**
     * @param ViewInterface $view
     */
    public function setView($view)
    {
        $this->view = $view;
    }

    /**
     * @param \Dkd\T3ciparadise\Domain\Repository\PageRepository $pageRepository
     */
    public function setPageRepository($pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * @return string
     */
    public function indexAction()
    {
        $rootPages = $this->pageRepository->findAllRootPages();
        $this->view->assign('rootPages', $rootPages);

        return $this->view->render();
    }
}
