<?php

declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFBase\Domain\Model\Agent;
use Digicademy\CHFBase\Domain\Repository\AgentRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for agents
 */
class AgentController extends ActionController
{
    private AgentRepository $agentRepository;

    public function injectAgentRepository(AgentRepository $agentRepository): void
    {
        $this->agentRepository = $agentRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('agents', $this->agentRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Agent $agent): ResponseInterface
    {
        $this->view->assign('agent', $agent);
        return $this->htmlResponse();
    }
}

?>
