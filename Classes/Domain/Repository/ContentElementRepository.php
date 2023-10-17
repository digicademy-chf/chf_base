<?php

declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Repository;

use Digicademy\CHFBase\Domain\Model\ContentElement;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for ContentElement
 * 
 * @extends Repository<ContentElement>
 */
class ContentElementRepository extends Repository
{
    protected $defaultOrderings = [
        'sorting'  => QueryInterface::ORDER_ASCENDING,
        'header'   => QueryInterface::ORDER_ASCENDING,
        'bodytext' => QueryInterface::ORDER_ASCENDING,
    ];
}

?>