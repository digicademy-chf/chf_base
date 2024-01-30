<?php
defined('TYPO3') or die();
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Repository;

use Digicademy\CHFBase\Domain\Model\AbstractRelation;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for AbstractRelation
 * 
 * @extends Repository<AbstractRelation>
 */
class AbstractRelationRepository extends Repository
{
    protected $defaultOrderings = [
        'sorting' => QueryInterface::ORDER_ASCENDING,
        'uuid'    => QueryInterface::ORDER_ASCENDING,
        'type'    => QueryInterface::ORDER_ASCENDING,
    ];
}
