<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFBase\Domain\Model\Extent;
use Digicademy\CHFBase\Domain\Repository\ExtentRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

defined('TYPO3') or die();

/**
 * Controller for Extent
 */
class ExtentController extends ActionController
{
    private ExtentRepository $extentRepository;

    public function injectExtentRepository(ExtentRepository $extentRepository): void
    {
        $this->extentRepository = $extentRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('extents', $this->extentRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Extent $extent): ResponseInterface
    {
        $this->view->assign('extent', $extent);
        return $this->htmlResponse();
    }
}
