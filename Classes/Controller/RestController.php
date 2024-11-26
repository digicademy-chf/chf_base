<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Controller;

use Digicademy\CHFBase\Domain\Repository\AbstractResourceRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

defined('TYPO3') or die();

/**
 * Controller for Rest
 */
class RestController extends ActionController
{
    private AbstractResourceRepository $abstractResourceRepository;

    public function injectAbstractResourceRepository(AbstractResourceRepository $abstractResourceRepository): void
    {
        $this->abstractResourceRepository = $abstractResourceRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $resourceIdentifier = $this->settings['resource'];
        $this->view->assign('resource', $this->abstractResourceRepository->findByIdentifier($resourceIdentifier));
        return $this->htmlResponse();
    }
}
