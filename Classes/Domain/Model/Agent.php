<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;
use Digicademy\CHFBib\Domain\Model\BibliographicResource;
use Digicademy\CHFGloss\Domain\Model\GlossaryResource;
use Digicademy\CHFLex\Domain\Model\LexicographicResource;
use Digicademy\CHFMap\Domain\Model\MapResource;
use Digicademy\CHFObject\Domain\Model\ObjectResource;
use Digicademy\CHFPub\Domain\Model\PublicationResource;

defined('TYPO3') or die();

/**
 * Model for Agent
 */
class Agent extends AbstractHeritage
{
    /**
     * Specific type of agent
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'person',
                'organisation',
                'otherEntity',
            ],
        ],
    ])]
    protected string $type = 'person';

    /**
     * Forename of the agent
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $forename = '';

    /**
     * Surname of the agent
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $surname = '';

    /**
     * Single name for a corporate body used instead of forename and surname
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $corporateName = '';

    /**
     * Common alternative name used, i.e., as a search term
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $alternativeName = '';

    /**
     * Academic or official title
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $honorific = '';

    /**
     * Name of job or occupation
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $occupation = '';

    /**
     * Social gender of the agent
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $gender = '';

    /**
     * Room to list employees or organisational units
     * 
     * @var ?ObjectStorage<Agent>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $agent = null;

    /**
     * Room to list biographical events
     * 
     * @var ?ObjectStorage<Period>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $event = null;

    /**
     * Agent related to this record
     * 
     * @var ?ObjectStorage<AgentRelation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $agentRelation = null;

    /**
     * Location related to this record
     * 
     * @var ?ObjectStorage<LocationRelation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $locationRelation = null;

    /**
     * Makes this agent selectable as an author
     * 
     * @var bool
     */
    #[Validate([
        'validator' => 'Boolean',
    ])]
    protected bool $isContributor = false;

    /**
     * Larger agent that this agent is part of
     * 
     * @var Agent|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected Agent|LazyLoadingProxy|null $parentAgent = null;

    /**
     * List of agent relations that use this agent
     * 
     * @var ?ObjectStorage<AgentRelation>
     */
    #[Lazy()]
    protected ?ObjectStorage $asAgentOfAgentRelation = null;

    /**
     * List of authorship relations that use this agent
     * 
     * @var ?ObjectStorage<AuthorshipRelation>
     */
    #[Lazy()]
    protected ?ObjectStorage $asContributorOfAuthorshipRelation = null;

    /**
     * Construct object
     *
     * @param string $type
     * @param BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource
     * @param string $iri
     * @param string $uuid
     * @return Agent
     */
    public function __construct(string $type, BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource, string $iri, string $uuid)
    {
        parent::__construct($parentResource, $iri, $uuid);
        $this->initializeObject();

        $this->setType($type);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->agent ??= new ObjectStorage();
        $this->event ??= new ObjectStorage();
        $this->agentRelation ??= new ObjectStorage();
        $this->locationRelation ??= new ObjectStorage();
        $this->asAgentOfAgentRelation ??= new ObjectStorage();
        $this->asContributorOfAuthorshipRelation ??= new ObjectStorage();
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * Get forename
     *
     * @return string
     */
    public function getForename(): string
    {
        return $this->forename;
    }

    /**
     * Set forename
     *
     * @param string $forename
     */
    public function setForename(string $forename): void
    {
        $this->forename = $forename;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * Set surname
     *
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * Get corporate name
     *
     * @return string
     */
    public function getCorporateName(): string
    {
        return $this->corporateName;
    }

    /**
     * Set corporate name
     *
     * @param string $corporateName
     */
    public function setCorporateName(string $corporateName): void
    {
        $this->corporateName = $corporateName;
    }

    /**
     * Get alternative name
     *
     * @return string
     */
    public function getAlternativeName(): string
    {
        return $this->alternativeName;
    }

    /**
     * Set alternative name
     *
     * @param string $alternativeName
     */
    public function setAlternativeName(string $alternativeName): void
    {
        $this->alternativeName = $alternativeName;
    }

    /**
     * Get honorific
     *
     * @return string
     */
    public function getHonorific(): string
    {
        return $this->honorific;
    }

    /**
     * Set honorific
     *
     * @param string $honorific
     */
    public function setHonorific(string $honorific): void
    {
        $this->honorific = $honorific;
    }

    /**
     * Get occupation
     *
     * @return string
     */
    public function getOccupation(): string
    {
        return $this->occupation;
    }

    /**
     * Set occupation
     *
     * @param string $occupation
     */
    public function setOccupation(string $occupation): void
    {
        $this->occupation = $occupation;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * Set gender
     *
     * @param string $gender
     */
    public function setGender(string $gender): void
    {
        $this->gender = $gender;
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
     * Get event
     *
     * @return ObjectStorage<Period>
     */
    public function getEvent(): ?ObjectStorage
    {
        return $this->event;
    }

    /**
     * Set event
     *
     * @param ObjectStorage<Period> $event
     */
    public function setEvent(ObjectStorage $event): void
    {
        $this->event = $event;
    }

    /**
     * Add event
     *
     * @param Period $event
     */
    public function addEvent(Period $event): void
    {
        $this->event?->attach($event);
    }

    /**
     * Remove event
     *
     * @param Period $event
     */
    public function removeEvent(Period $event): void
    {
        $this->event?->detach($event);
    }

    /**
     * Remove all events
     */
    public function removeAllEvent(): void
    {
        $event = clone $this->event;
        $this->event->removeAll($event);
    }

    /**
     * Get agent relation
     *
     * @return ObjectStorage<AgentRelation>
     */
    public function getAgentRelation(): ?ObjectStorage
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
        $this->agentRelation?->attach($agentRelation);
    }

    /**
     * Remove agent relation
     *
     * @param AgentRelation $agentRelation
     */
    public function removeAgentRelation(AgentRelation $agentRelation): void
    {
        $this->agentRelation?->detach($agentRelation);
    }

    /**
     * Remove all agent relations
     */
    public function removeAllAgentRelation(): void
    {
        $agentRelation = clone $this->agentRelation;
        $this->agentRelation->removeAll($agentRelation);
    }

    /**
     * Get location relation
     *
     * @return ObjectStorage<LocationRelation>
     */
    public function getLocationRelation(): ?ObjectStorage
    {
        return $this->locationRelation;
    }

    /**
     * Set location relation
     *
     * @param ObjectStorage<LocationRelation> $locationRelation
     */
    public function setLocationRelation(ObjectStorage $locationRelation): void
    {
        $this->locationRelation = $locationRelation;
    }

    /**
     * Add location relation
     *
     * @param LocationRelation $locationRelation
     */
    public function addLocationRelation(LocationRelation $locationRelation): void
    {
        $this->locationRelation?->attach($locationRelation);
    }

    /**
     * Remove location relation
     *
     * @param LocationRelation $locationRelation
     */
    public function removeLocationRelation(LocationRelation $locationRelation): void
    {
        $this->locationRelation?->detach($locationRelation);
    }

    /**
     * Remove all location relations
     */
    public function removeAllLocationRelation(): void
    {
        $locationRelation = clone $this->locationRelation;
        $this->locationRelation->removeAll($locationRelation);
    }

    /**
     * Get is contributor
     *
     * @return bool
     */
    public function getIsContributor(): bool
    {
        return $this->isContributor;
    }

    /**
     * Set is contributor
     *
     * @param bool $isContributor
     */
    public function setIsContributor(bool $isContributor): void
    {
        $this->isContributor = $isContributor;
    }

    /**
     * Get parent agent
     * 
     * @return Agent
     */
    public function getParentAgent(): Agent
    {
        if ($this->parentAgent instanceof LazyLoadingProxy) {
            $this->parentAgent->_loadRealInstance();
        }
        return $this->parentAgent;
    }

    /**
     * Set parent agent
     * 
     * @param Agent
     */
    public function setParentAgent(Agent $parentAgent): void
    {
        $this->parentAgent = $parentAgent;
    }

    /**
     * Get as agent of agent relation
     *
     * @return ObjectStorage<AgentRelation>
     */
    public function getAsAgentOfAgentRelation(): ?ObjectStorage
    {
        return $this->asAgentOfAgentRelation;
    }

    /**
     * Set as agent of agent relation
     *
     * @param ObjectStorage<AgentRelation> $asAgentOfAgentRelation
     */
    public function setAsAgentOfAgentRelation(ObjectStorage $asAgentOfAgentRelation): void
    {
        $this->asAgentOfAgentRelation = $asAgentOfAgentRelation;
    }

    /**
     * Add as agent of agent relation
     *
     * @param AgentRelation $asAgentOfAgentRelation
     */
    public function addAsAgentOfAgentRelation(AgentRelation $asAgentOfAgentRelation): void
    {
        $this->asAgentOfAgentRelation?->attach($asAgentOfAgentRelation);
    }

    /**
     * Remove as agent of agent relation
     *
     * @param AgentRelation $asAgentOfAgentRelation
     */
    public function removeAsAgentOfAgentRelation(AgentRelation $asAgentOfAgentRelation): void
    {
        $this->asAgentOfAgentRelation?->detach($asAgentOfAgentRelation);
    }

    /**
     * Remove all as agent of agent relations
     */
    public function removeAllAsAgentOfAgentRelation(): void
    {
        $asAgentOfAgentRelation = clone $this->asAgentOfAgentRelation;
        $this->asAgentOfAgentRelation->removeAll($asAgentOfAgentRelation);
    }

    /**
     * Get as contributor of authorship relation
     *
     * @return ObjectStorage<AuthorshipRelation>
     */
    public function getAsContributorOfAuthorshipRelation(): ?ObjectStorage
    {
        return $this->asContributorOfAuthorshipRelation;
    }

    /**
     * Set as contributor of authorship relation
     *
     * @param ObjectStorage<AuthorshipRelation> $asContributorOfAuthorshipRelation
     */
    public function setAsContributorOfAuthorshipRelation(ObjectStorage $asContributorOfAuthorshipRelation): void
    {
        $this->asContributorOfAuthorshipRelation = $asContributorOfAuthorshipRelation;
    }

    /**
     * Add as contributor of authorship relation
     *
     * @param AuthorshipRelation $asContributorOfAuthorshipRelation
     */
    public function addAsContributorOfAuthorshipRelation(AuthorshipRelation $asContributorOfAuthorshipRelation): void
    {
        $this->asContributorOfAuthorshipRelation?->attach($asContributorOfAuthorshipRelation);
    }

    /**
     * Remove as contributor of authorship relation
     *
     * @param AuthorshipRelation $asContributorOfAuthorshipRelation
     */
    public function removeAsContributorOfAuthorshipRelation(AuthorshipRelation $asContributorOfAuthorshipRelation): void
    {
        $this->asContributorOfAuthorshipRelation?->detach($asContributorOfAuthorshipRelation);
    }

    /**
     * Remove all as contributor of authorship relations
     */
    public function removeAllAsContributorOfAuthorshipRelation(): void
    {
        $asContributorOfAuthorshipRelation = clone $this->asContributorOfAuthorshipRelation;
        $this->asContributorOfAuthorshipRelation->removeAll($asContributorOfAuthorshipRelation);
    }
}
