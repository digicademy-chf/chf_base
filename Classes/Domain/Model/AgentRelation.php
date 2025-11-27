<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use Digicademy\CHFBase\Domain\Model\Traits\RecordTrait;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;
use Digicademy\CHFLex\Domain\Model\Example;
use Digicademy\CHFMedia\Domain\Model\FileGroup;
use Digicademy\CHFObject\Domain\Model\SingleObject;
use Digicademy\CHFObject\Domain\Model\ObjectGroup;
use TYPO3\CMS\Extbase\Attribute\ORM\Lazy;
use TYPO3\CMS\Extbase\Attribute\Validate;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for AgentRelation
 */
class AgentRelation extends AbstractRelation
{
    use RecordTrait;

    /**
     * Agents to relate to the record
     * 
     * @var ObjectStorage<Agent>
     */
    #[Lazy()]
    protected ObjectStorage $agent;

    /**
     * Qualification of this relation
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'agency',
                'relationship',
                'depiction',
                'representation',
                'designer',
                'artist',
                'workshop',
                'manufacturer',
                'benefactor',
                'collector',
                'curator',
                'restorer',
            ],
        ],
    ])]
    protected string $role = 'artist';

    /**
     * Construct object
     *
     * @param Agent|Location|Period|Example|FileGroup|SingleObject|ObjectGroup $record
     * @param Agent $agent
     * @return AgentRelation
     */
    public function __construct(Agent|Location|Period|Example|FileGroup|SingleObject|ObjectGroup $record, Agent $agent)
    {
        parent::__construct();
        $this->initializeObject();

        $this->setType('agentRelation');
        $this->setRecord($record);
        $this->addAgent($agent);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->agent = new ObjectStorage();
    }

    /**
     * Get agent
     *
     * @return ObjectStorage<Agent>
     */
    public function getAgent(): ObjectStorage
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
        $this->agent->attach($agent);
    }

    /**
     * Remove agent
     *
     * @param Agent $agent
     */
    public function removeAgent(Agent $agent): void
    {
        $this->agent->detach($agent);
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
