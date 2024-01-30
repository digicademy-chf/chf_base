<?php
defined('TYPO3') or die();
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFBase\Domain\Model\AbstractRelation;
use Digicademy\CHFBase\Domain\Repository\AbstractRelationRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for AbstractRelation
 */
class AbstractRelationController extends ActionController
{
    private AbstractRelationRepository $abstractRelationRepository;

    public function injectAbstractRelationRepository(AbstractRelationRepository $abstractRelationRepository): void
    {
        $this->abstractRelationRepository = $abstractRelationRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('relations', $this->abstractRelationRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(AbstractRelation $abstractRelation): ResponseInterface
    {
        $this->view->assign('relation', $abstractRelation);
        return $this->htmlResponse();
    }
}
