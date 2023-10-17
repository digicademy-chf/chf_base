<?php

declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Repository;

use Digicademy\CHFBase\Domain\Model\Agent;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for agents
 * 
 * @extends Repository<Agent>
 */
class AgentRepository extends Repository
{
    protected $defaultOrderings = [
        'sorting'         => QueryInterface::ORDER_ASCENDING,
        'isHighlight'     => QueryInterface::ORDER_ASCENDING,
        'surname'         => QueryInterface::ORDER_ASCENDING,
        'forename'        => QueryInterface::ORDER_ASCENDING,
        'corporateName'   => QueryInterface::ORDER_ASCENDING,
        'alternativeName' => QueryInterface::ORDER_ASCENDING,
        'type'            => QueryInterface::ORDER_ASCENDING,
    ];
}

?>
