<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFBase\Domain\Model\Keyword;
use Digicademy\CHFBase\Domain\Repository\KeywordRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

defined('TYPO3') or die();

/**
 * Controller for Keyword
 */
class KeywordController extends ActionController
{
    private KeywordRepository $keywordRepository;

    public function injectKeywordRepository(KeywordRepository $keywordRepository): void
    {
        $this->keywordRepository = $keywordRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('keywords', $this->keywordRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Keyword $keyword): ResponseInterface
    {
        $this->view->assign('keyword', $keyword);
        return $this->htmlResponse();
    }
}
