<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model\Traits;

use Digicademy\CHFBase\Domain\Model\AgentRelation;
use TYPO3\CMS\Extbase\Attribute\ORM\Lazy;
use TYPO3\CMS\Extbase\Attribute\ORM\Cascade;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Trait for models to include an agent-relation property
 */
trait AgentRelationTrait
{
    /**
     * Agent related to this record
     * 
     * @var ObjectStorage<AgentRelation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $agentRelation;

    /**
     * Get agent relation
     *
     * @return ObjectStorage<AgentRelation>
     */
    public function getAgentRelation(): ObjectStorage
    {
        return $this->agentRelation;
    }

    /**
     * Set agent relation
     *
     * @param ObjectStorage<AgentRelation> $agentRelation
     */
    public function setAgentRelation(ObjectStorage $agentRelation): void
    {
        $this->agentRelation = $agentRelation;
    }

    /**
     * Add agent relation
     *
     * @param AgentRelation $agentRelation
     */
    public function addAgentRelation(AgentRelation $agentRelation): void
    {
        $this->agentRelation->attach($agentRelation);
    }

    /**
     * Remove agent relation
     *
     * @param AgentRelation $agentRelation
     */
    public function removeAgentRelation(AgentRelation $agentRelation): void
    {
        $this->agentRelation->detach($agentRelation);
    }

    /**
     * Remove all agent relations
     */
    public function removeAllAgentRelation(): void
    {
        $agentRelation = clone $this->agentRelation;
        $this->agentRelation->removeAll($agentRelation);
    }
}
