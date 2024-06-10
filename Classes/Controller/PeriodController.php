<?php
declare(strict_types=1);
defined('TYPO3') or die();

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFBase\Domain\Model\Period;
use Digicademy\CHFBase\Domain\Repository\PeriodRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for Period
 */
class PeriodController extends ActionController
{
    private PeriodRepository $periodRepository;

    public function injectPeriodRepository(PeriodRepository $periodRepository): void
    {
        $this->periodRepository = $periodRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('periods', $this->periodRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Period $period): ResponseInterface
    {
        $this->view->assign('period', $period);
        return $this->htmlResponse();
    }
}
