<?php

declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFBase\Domain\Model\Resource;
use Digicademy\CHFBase\Domain\Repository\ResourceRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for resources
 */
class ResourceController extends ActionController
{
    private ResourceRepository $resourceRepository;

    public function injectResourceRepository(ResourceRepository $resourceRepository): void
    {
        $this->resourceRepository = $resourceRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('resources', $this->resourceRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Resource $resource): ResponseInterface
    {
        $this->view->assign('resource', $resource);
        return $this->htmlResponse();
    }
}

?>
