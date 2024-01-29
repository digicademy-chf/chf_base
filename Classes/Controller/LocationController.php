<?php
defined('TYPO3') or die();
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFBase\Domain\Model\Location;
use Digicademy\CHFBase\Domain\Repository\LocationRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for Location
 */
class LocationController extends ActionController
{
    private LocationRepository $locationRepository;

    public function injectLocationRepository(LocationRepository $locationRepository): void
    {
        $this->locationRepository = $locationRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('locations', $this->locationRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Location $location): ResponseInterface
    {
        $this->view->assign('location', $location);
        return $this->htmlResponse();
    }
}

?>
