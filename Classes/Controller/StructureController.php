<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Controller;

use Digicademy\CHFBase\Domain\Model\AbstractTag;
use Digicademy\CHFBase\Domain\Model\Keyword;
use Digicademy\CHFBase\Domain\Repository\AbstractResourceRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

defined('TYPO3') or die();

/**
 * Controller for Structure
 */
class StructureController extends ActionController
{
    /**
     * Constructor takes care of dependency injection
     */
    public function __construct(
        protected readonly AbstractResourceRepository $abstractResourceRepository,
    ) {}

    /**
     * Show tag and keyword list
     *
     * @return ResponseInterface
     */
    public function indexAction(): ResponseInterface
    {
        // Get resource
        $resourceIdentifier = $this->settings['resource'];
        $this->view->assign('resource', $this->abstractResourceRepository->findByIdentifier($resourceIdentifier));

        // Create response
        return $this->htmlResponse();
    }

    /**
     * Show single tag
     *
     * @param AbstractTag $abstractTag
     * @return ResponseInterface
     */
    public function showAction(AbstractTag $abstractTag): ResponseInterface
    {
        // Get tag
        $this->view->assign('tag', $abstractTag);

        // Create response
        return $this->htmlResponse();
    }

    /**
     * Show single keyword
     *
     * @param Keyword $keyword
     * @return ResponseInterface
     */
    public function showKeywordAction(Keyword $keyword): ResponseInterface
    {
        // Get keyword
        $this->view->assign('keyword', $keyword);

        // Create response
        return $this->htmlResponse();
    }
}
