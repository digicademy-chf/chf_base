<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Controller;

use Digicademy\CHFBase\Domain\Model\Agent;
use Digicademy\CHFBase\Domain\Repository\AbstractResourceRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

defined('TYPO3') or die();

/**
 * Controller for Agents
 */
class AgentsController extends ActionController
{
    /**
     * Constructor takes care of dependency injection
     */
    public function __construct(
        protected readonly AbstractResourceRepository $abstractResourceRepository,
    ) {}

    /**
     * Show agent list
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
     * Show single agent
     *
     * @param Agent $agent
     * @return ResponseInterface
     */
    public function showAction(Agent $agent): ResponseInterface
    {
        // Get agent
        $this->view->assign('agent', $agent);

        // Create response
        return $this->htmlResponse();
    }
}
