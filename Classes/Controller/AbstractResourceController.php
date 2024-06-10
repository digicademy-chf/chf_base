<?php
declare(strict_types=1);
defined('TYPO3') or die();

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFBase\Domain\Model\AbstractResource;
use Digicademy\CHFBase\Domain\Repository\AbstractResourceRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for AbstractResource
 */
class AbstractResourceController extends ActionController
{
    private AbstractResourceRepository $abstractResourceRepository;

    public function injectAbstractResourceRepository(AbstractResourceRepository $abstractResourceRepository): void
    {
        $this->abstractResourceRepository = $abstractResourceRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('resources', $this->abstractResourceRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(AbstractResource $abstractResource): ResponseInterface
    {
        $this->view->assign('resource', $abstractResource);
        return $this->htmlResponse();
    }
}
