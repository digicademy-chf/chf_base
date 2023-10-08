<?php

declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFBase\Domain\Model\Date;
use Digicademy\CHFBase\Domain\Repository\DateRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for dates
 */
class DateController extends ActionController
{
    private DateRepository $dateRepository;

    public function injectDateRepository(DateRepository $dateRepository): void
    {
        $this->dateRepository = $dateRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('dates', $this->dateRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Date $date): ResponseInterface
    {
        $this->view->assign('date', $date);
        return $this->htmlResponse();
    }
}

?>
