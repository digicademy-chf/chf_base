<?php
defined('TYPO3') or die();
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFBase\Domain\Model\ContentElement;
use Digicademy\CHFBase\Domain\Repository\ContentElementRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for ContentElement
 */
class ContentElementController extends ActionController
{
    private ContentElementRepository $contentElementRepository;

    public function injectContentElementRepository(ContentElementRepository $contentElementRepository): void
    {
        $this->contentElementRepository = $contentElementRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('contentElements', $this->contentElementRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(ContentElement $contentElement): ResponseInterface
    {
        $this->view->assign('contentElement', $contentElement);
        return $this->htmlResponse();
    }
}
