<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Controller;
use Digicademy\CHFBase\Domain\Model\Period;
use Digicademy\CHFBase\Domain\Repository\AbstractResourceRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Cache\CacheTag;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

defined('TYPO3') or die();

/**
 * Controller for Timeline
 */
class TimelineController extends ActionController
{
    private AbstractResourceRepository $abstractResourceRepository;

    public function injectAbstractResourceRepository(AbstractResourceRepository $abstractResourceRepository): void
    {
        $this->abstractResourceRepository = $abstractResourceRepository;
    }

    /**
     * Show period list
     *
     * @return ResponseInterface
     */
    public function indexAction(): ResponseInterface
    {
        // Get resource
        $resourceIdentifier = $this->settings['resource'];
        $this->view->assign('resource', $this->abstractResourceRepository->findByIdentifier($resourceIdentifier));

        // Set cache tag
        $cacheDataCollector = $this->request->getAttribute('frontend.cache.collector');
        $cacheDataCollector->addCacheTags(
            new CacheTag('chf')
        );

        // Create response
        return $this->htmlResponse();
    }

    /**
     * Show single period
     *
     * @param Period $period
     * @return ResponseInterface
     */
    public function showAction(Period $period): ResponseInterface
    {
        // Get period
        $this->view->assign('period', $period);

        // Set cache tag
        $cacheDataCollector = $this->request->getAttribute('frontend.cache.collector');
        $cacheDataCollector->addCacheTags(
            new CacheTag('chf')
        );

        // Create response
        return $this->htmlResponse();
    }
}
