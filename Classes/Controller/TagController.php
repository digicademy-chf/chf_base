<?php

declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFBase\Domain\Model\Tag;
use Digicademy\CHFBase\Domain\Repository\TagRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for tags
 */
class TagController extends ActionController
{
    private TagRepository $tagRepository;

    public function injectTagRepository(TagRepository $tagRepository): void
    {
        $this->tagRepository = $tagRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('tags', $this->tagRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Tag $tag): ResponseInterface
    {
        $this->view->assign('tag', $tag);
        return $this->htmlResponse();
    }
}

?>
