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
 * Model for Period
 */
class Period extends AbstractHeritage
{
    /**
     * Type of period
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'date',
                'event',
                'period',
                'century',
                'era',
            ],
        ],
    ])]
    protected string $type = 'date';

    /**
     * Name of the calendar used to generate dates
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'gregorian',
            ],
        ],
    ])]
    protected string $calendar = 'gregorian';

    /**
     * Name of the period or event
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $text = '';

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
    protected string $alternativeText = '';

    /**
     * Exact date of an event
     * 
     * @var ?\DateTime
     */
    protected ?\DateTime $when = null;

    /**
     * Text version of the date
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $displayDate = '';

    /**
     * Start date for fuzzier time spans
     * 
     * @var ?\DateTime
     */
    protected ?\DateTime $from = null;

    /**
     * End date for fuzzier time spans
     * 
     * @var ?\DateTime
     */
    protected ?\DateTime $to = null;

    /**
     * Earliest possible date for very fuzzy periods or events
     * 
     * @var ?\DateTime
     */
    protected ?\DateTime $notBefore = null;

    /**
     * Latest possible date for very fuzzy periods or events
     * 
     * @var ?\DateTime
     */
    protected ?\DateTime $notAfter = null;

    /**
     * Room to list more specific historical events
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
     * Longer period that this period is part of
     * 
     * @var Period|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected Period|LazyLoadingProxy|null $parentPeriod = null;

    /**
     * Construct object
     *
     * @param string $type
     * @param BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource
     * @return Period
     */
    public function __construct(string $type, BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource)
    {
        parent::__construct($parentResource);
        $this->initializeObject();

        $this->setType($type);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->event ??= new ObjectStorage();
        $this->agentRelation ??= new ObjectStorage();
        $this->locationRelation ??= new ObjectStorage();
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
     * Get calendar
     *
     * @return string
     */
    public function getCalendar(): string
    {
        return $this->calendar;
    }

    /**
     * Set calendar
     *
     * @param string $calendar
     */
    public function setCalendar(string $calendar): void
    {
        $this->calendar = $calendar;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Set text
     *
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * Get alternative text
     *
     * @return string
     */
    public function getAlternativeText(): string
    {
        return $this->alternativeText;
    }

    /**
     * Set alternative text
     *
     * @param string $alternativeText
     */
    public function setAlternativeText(string $alternativeText): void
    {
        $this->alternativeText = $alternativeText;
    }

    /**
     * Get when
     *
     * @return ?\DateTime
     */
    public function getWhen(): ?\DateTime
    {
        return $this->when;
    }

    /**
     * Set when
     *
     * @param \DateTime $when
     */
    public function setWhen(\DateTime $when): void
    {
        $this->when = $when;
    }

    /**
     * Get display date
     *
     * @return string
     */
    public function getDisplayDate(): string
    {
        return $this->displayDate;
    }

    /**
     * Set display date
     *
     * @param string $displayDate
     */
    public function setDisplayDate(string $displayDate): void
    {
        $this->displayDate = $displayDate;
    }

    /**
     * Get to
     *
     * @return ?\DateTime
     */
    public function getTo(): ?\DateTime
    {
        return $this->to;
    }

    /**
     * Set to
     *
     * @param \DateTime $to
     */
    public function setTo(\DateTime $to): void
    {
        $this->to = $to;
    }

    /**
     * Get from
     *
     * @return ?\DateTime
     */
    public function getFrom(): ?\DateTime
    {
        return $this->from;
    }

    /**
     * Set from
     *
     * @param \DateTime $from
     */
    public function setFrom(\DateTime $from): void
    {
        $this->from = $from;
    }

    /**
     * Get not before
     *
     * @return ?\DateTime
     */
    public function getNotBefore(): ?\DateTime
    {
        return $this->notBefore;
    }

    /**
     * Set not before
     *
     * @param \DateTime $notBefore
     */
    public function setNotBefore(\DateTime $notBefore): void
    {
        $this->notBefore = $notBefore;
    }

    /**
     * Get not after
     *
     * @return ?\DateTime
     */
    public function getNotAfter(): ?\DateTime
    {
        return $this->notAfter;
    }

    /**
     * Set not after
     *
     * @param \DateTime $notAfter
     */
    public function setNotAfter(\DateTime $notAfter): void
    {
        $this->notAfter = $notAfter;
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
     * Get parent period
     * 
     * @return Period
     */
    public function getParentPeriod(): Period
    {
        if ($this->parentPeriod instanceof LazyLoadingProxy) {
            $this->parentPeriod->_loadRealInstance();
        }
        return $this->parentPeriod;
    }

    /**
     * Set parent period
     * 
     * @param Period
     */
    public function setParentPeriod(Period $parentPeriod): void
    {
        $this->parentPeriod = $parentPeriod;
    }
}
