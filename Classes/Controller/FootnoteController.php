<?php
declare(strict_types=1);
defined('TYPO3') or die();

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFBase\Domain\Model\Footnote;
use Digicademy\CHFBase\Domain\Repository\FootnoteRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for Footnote
 */
class FootnoteController extends ActionController
{
    private FootnoteRepository $footnoteRepository;

    public function injectFootnoteRepository(FootnoteRepository $footnoteRepository): void
    {
        $this->footnoteRepository = $footnoteRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('footnotes', $this->footnoteRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Footnote $footnote): ResponseInterface
    {
        $this->view->assign('footnote', $footnote);
        return $this->htmlResponse();
    }
}
