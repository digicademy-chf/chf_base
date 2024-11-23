<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;
use Digicademy\CHFBib\Domain\Model\BibliographicResource;
use Digicademy\CHFGloss\Domain\Model\GlossaryResource;
use Digicademy\CHFLex\Domain\Model\Example;
use Digicademy\CHFLex\Domain\Model\LexicographicResource;
use Digicademy\CHFMap\Domain\Model\MapResource;
use Digicademy\CHFMedia\Domain\Model\FileGroup;
use Digicademy\CHFObject\Domain\Model\ObjectGroup;
use Digicademy\CHFObject\Domain\Model\ObjectResource;
use Digicademy\CHFObject\Domain\Model\SingleObject;
use Digicademy\CHFPub\Domain\Model\PublicationResource;

defined('TYPO3') or die();

/**
 * Model for AgentRelation
 */
class AgentRelation extends AbstractRelation
{
    /**
     * Record to connect a relation to
     * 
     * @var Agent|Location|Period|Example|FileGroup|SingleObject|ObjectGroup|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected Agent|Location|Period|Example|FileGroup|SingleObject|ObjectGroup|null $record = null;

    /**
     * Agents to relate to the record
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
     * @param BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource
     * @param string $uuid
     * @return AgentRelation
     */
    public function __construct(Agent|Location|Period|Example|FileGroup|SingleObject|ObjectGroup $record, Agent $agent, BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource, string $uuid)
    {
        parent::__construct($parentResource, $uuid);
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
        $this->agent ??= new ObjectStorage();
    }

    /**
     * Get record
     * 
     * @return Agent|Location|Period|Example|FileGroup|SingleObject|ObjectGroup
     */
    public function getRecord(): Agent|Location|Period|Example|FileGroup|SingleObject|ObjectGroup
    {
        if ($this->record instanceof LazyLoadingProxy) {
            $this->record->_loadRealInstance();
        }
        return $this->record;
    }

    /**
     * Set record
     * 
     * @param Agent|Location|Period|Example|FileGroup|SingleObject|ObjectGroup
     */
    public function setRecord(Agent|Location|Period|Example|FileGroup|SingleObject|ObjectGroup $record): void
    {
        $this->record = $record;
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
