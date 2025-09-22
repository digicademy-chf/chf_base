<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use Digicademy\CHFBase\Domain\Model\Traits\AgentRelationTrait;
use Digicademy\CHFBase\Domain\Model\Traits\LocationRelationTrait;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for Agent
 */
class Agent extends AbstractHeritage
{
    use AgentRelationTrait;
    use LocationRelationTrait;

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
     * @var ObjectStorage<Agent>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $agent;

    /**
     * Room to list biographical events
     * 
     * @var ObjectStorage<Period>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $event;

    /**
     * Larger agent that this agent is part of
     * 
     * @var Agent|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected Agent|LazyLoadingProxy|null $parentAgent = null;

    /**
     * Construct object
     *
     * @param string $type
     * @return Agent
     */
    public function __construct(string $type)
    {
        parent::__construct();
        $this->initializeObject();

        $this->setType($type);
        $this->setIri('a');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->agent = new ObjectStorage();
        $this->event = new ObjectStorage();
        $this->agentRelation = new ObjectStorage();
        $this->locationRelation = new ObjectStorage();
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
     * Get event
     *
     * @return ObjectStorage<Period>
     */
    public function getEvent(): ObjectStorage
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
        $this->event->attach($event);
    }

    /**
     * Remove event
     *
     * @param Period $event
     */
    public function removeEvent(Period $event): void
    {
        $this->event->detach($event);
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
}
