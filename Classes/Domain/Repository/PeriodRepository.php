<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Repository;

use Digicademy\CHFBase\Domain\Model\Period;
use Digicademy\CHFBase\Domain\Repository\Traits\StoragePageAgnosticTrait;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

defined('TYPO3') or die();

/**
 * Repository for Period
 * 
 * @extends Repository<Period>
 */
class PeriodRepository extends Repository
{
    use StoragePageAgnosticTrait;

    protected $defaultOrderings = [
        'sorting'         => QueryInterface::ORDER_ASCENDING,
        'isHighlight'     => QueryInterface::ORDER_ASCENDING,
        'when'            => QueryInterface::ORDER_ASCENDING,
        'from'            => QueryInterface::ORDER_ASCENDING,
        'to'              => QueryInterface::ORDER_ASCENDING,
        'notBefore'       => QueryInterface::ORDER_ASCENDING,
        'notAfter'        => QueryInterface::ORDER_ASCENDING,
        'text'            => QueryInterface::ORDER_ASCENDING,
        'alternativeText' => QueryInterface::ORDER_ASCENDING,
        'displayDate'     => QueryInterface::ORDER_ASCENDING,
        'type'            => QueryInterface::ORDER_ASCENDING,
    ];
}
