<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFBase\Domain\Model\AbstractTag;
use Digicademy\CHFBase\Domain\Repository\AbstractTagRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

defined('TYPO3') or die();

/**
 * Controller for AbstractTag
 */
class AbstractTagController extends ActionController
{
    private AbstractTagRepository $abstractTagRepository;

    public function injectAbstractTagRepository(AbstractTagRepository $abstractTagRepository): void
    {
        $this->abstractTagRepository = $abstractTagRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('tags', $this->abstractTagRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(AbstractTag $abstractTag): ResponseInterface
    {
        $this->view->assign('tag', $abstractTag);
        return $this->htmlResponse();
    }
}
