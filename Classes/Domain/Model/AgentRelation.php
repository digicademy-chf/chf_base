<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for AgentRelation
 */
class AgentRelation extends AbstractRelation
{
    /**
     * Record to connect a relation to
     * 
     * @var ?ObjectStorage<object>
     */
    #[Lazy()]
    protected ?ObjectStorage $record;

    /**
     * Agent to relate to the record
     * 
     * @var ?ObjectStorage<Agent>
     */
    #[Lazy()]
    protected ?ObjectStorage $agent;

    /**
     * Qualification of this relation
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                '0',
                'agency',
                'relationship',
            ],
        ],
    ])]
    protected string $role = '0';

    /**
     * Construct object
     *
     * @param object $parentResource
     * @param string $uuid
     * @param object $record
     * @param Agent $agent
     * @return AgentRelation
     */
    public function __construct(object $parentResource, string $uuid, object $record, Agent $agent)
    {
        parent::__construct($parentResource, $uuid);
        $this->initializeObject();

        $this->setType('agentRelation');
        $this->addRecord($record);
        $this->addAgent($agent);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->record ??= new ObjectStorage();
        $this->agent ??= new ObjectStorage();
    }

    /**
     * Get record
     *
     * @return ObjectStorage<object>
     */
    public function getRecord(): ?ObjectStorage
    {
        return $this->record;
    }

    /**
     * Set record
     *
     * @param ObjectStorage<object> $record
     */
    public function setRecord(ObjectStorage $record): void
    {
        $this->record = $record;
    }

    /**
     * Add record
     *
     * @param object $record
     */
    public function addRecord(object $record): void
    {
        $this->record?->attach($record);
    }

    /**
     * Remove record
     *
     * @param object $record
     */
    public function removeRecord(object $record): void
    {
        $this->record?->detach($record);
    }

    /**
     * Remove all records
     */
    public function removeAllRecord(): void
    {
        $record = clone $this->record;
        $this->record->removeAll($record);
    }

    /**
     * Get agent
     *
     * @return ObjectStorage<Agent>
     */
    public function getAgent(): ?ObjectStorage
    {
        return $this->agent;
    }

    /**
     * Set agent
     *
     * @param ObjectStorage<Agent> $agent
     */
    public function setAgent(ObjectStorage $agent): void
    {
        $this->agent = $agent;
    }

    /**
     * Add agent
     *
     * @param Agent $agent
     */
    public function addAgent(Agent $agent): void
    {
        $this->agent?->attach($agent);
    }

    /**
     * Remove agent
     *
     * @param Agent $agent
     */
    public function removeAgent(Agent $agent): void
    {
        $this->agent?->detach($agent);
    }

    /**
     * Remove all agents
     */
    public function removeAllAgent(): void
    {
        $agent = clone $this->agent;
        $this->agent->removeAll($agent);
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * Set role
     *
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }
}
