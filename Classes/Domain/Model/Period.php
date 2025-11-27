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
use TYPO3\CMS\Extbase\Attribute\ORM\Lazy;
use TYPO3\CMS\Extbase\Attribute\ORM\Cascade;
use TYPO3\CMS\Extbase\Attribute\Validate;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for Period
 */
class Period extends AbstractHeritage
{
    use AgentRelationTrait;
    use LocationRelationTrait;

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
    protected string $title = '';

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
    protected string $alternativeTitle = '';

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
     * @var ObjectStorage<Period>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $event;

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
     * @return Period
     */
    public function __construct(string $type)
    {
        parent::__construct();
        $this->initializeObject();

        $this->setType($type);
        $this->setIri('p');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
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
     * Get title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Get alternative title
     *
     * @return string
     */
    public function getAlternativeTitle(): string
    {
        return $this->alternativeTitle;
    }

    /**
     * Set alternative title
     *
     * @param string $alternativeTitle
     */
    public function setAlternativeTitle(string $alternativeTitle): void
    {
        $this->alternativeTitle = $alternativeTitle;
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
