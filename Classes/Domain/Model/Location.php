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
use Digicademy\CHFMap\Domain\Model\Feature;
use Digicademy\CHFMap\Domain\Model\FeatureCollection;
use Digicademy\CHFMap\Domain\Model\MapResource;

defined('TYPO3') or die();

/**
 * Model for Location
 */
class Location extends AbstractHeritage
{
    /**
     * Larger area that this location is part of
     * 
     * @var Location|LazyLoadingProxy
     */
    #[Lazy()]
    protected Location|LazyLoadingProxy $parentLocation;

    /**
     * Type of location
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'position',
                'building',
                'townOrCity',
                'regionOrState',
                'country',
                'continent',
            ],
        ],
    ])]
    protected string $type = 'position';

    /**
     * Name of this location
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $name = '';

    /**
     * Common alternative name that may, for example, be useful as a search term
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
     * Marks this location as historical
     * 
     * @var bool
     */
    #[Validate([
        'validator' => 'Boolean',
    ])]
    protected bool $isHistorical = false;

    /**
     * Marks this location as imaginary
     * 
     * @var bool
     */
    #[Validate([
        'validator' => 'Boolean',
    ])]
    protected bool $isImaginary = false;

    /**
     * Feature to use as geodata of this location
     * 
     * @var Feature|FeatureCollection|LazyLoadingProxy
     */
    #[Lazy()]
    protected Feature|FeatureCollection|LazyLoadingProxy $geodata;

    /**
     * Map depicting this location
     * 
     * @var MapResource|LazyLoadingProxy
     */
    #[Lazy()]
    protected MapResource|LazyLoadingProxy $locationPlan;

    /**
     * Room to list historical events
     * 
     * @var ?ObjectStorage<Period>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $event = null;

    /**
     * Agent of this database record described by a relation
     * 
     * @var ?ObjectStorage<AgentRelation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $agentRelation = null;

    /**
     * Street as part of the location's address
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $addressStreet = '';

    /**
     * Number as part of the location's address
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $addressNumber = '';

    /**
     * ZIP code as part of the location's address
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $addressZip = '';

    /**
     * City as part of the location's address
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $addressCity = '';

    /**
     * List of location relations that use this location
     * 
     * @var ?ObjectStorage<LocationRelation>
     */
    #[Lazy()]
    protected ?ObjectStorage $asLocationOfLocationRelation = null;

    /**
     * Construct object
     *
     * @param object $parentResource
     * @param string $uuid
     * @param string $type
     * @param string $name
     * @return Location
     */
    public function __construct(object $parentResource, string $uuid, string $type, string $name)
    {
        parent::__construct($parentResource, $uuid);
        $this->initializeObject();

        $this->setType($type);
        $this->setName($name);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->parentLocation = new LazyLoadingProxy();
        $this->geodata = new LazyLoadingProxy();
        $this->locationPlan = new LazyLoadingProxy();
        $this->event ??= new ObjectStorage();
        $this->agentRelation ??= new ObjectStorage();
        $this->asLocationOfLocationRelation ??= new ObjectStorage();
    }

    /**
     * Get parent location
     * 
     * @return Location
     */
    public function getParentLocation(): Location
    {
        if ($this->parentLocation instanceof LazyLoadingProxy) {
            $this->parentLocation->_loadRealInstance();
        }
        return $this->parentLocation;
    }

    /**
     * Set parent location
     * 
     * @param Location
     */
    public function setParentLocation(Location $parentLocation): void
    {
        $this->parentLocation = $parentLocation;
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
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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
     * Get is historical
     *
     * @return bool
     */
    public function getIsHistorical(): bool
    {
        return $this->isHistorical;
    }

    /**
     * Set is historical
     *
     * @param bool $isHistorical
     */
    public function setIsHistorical(bool $isHistorical): void
    {
        $this->isHistorical = $isHistorical;
    }

    /**
     * Get is imaginary
     *
     * @return bool
     */
    public function getIsImaginary(): bool
    {
        return $this->isImaginary;
    }

    /**
     * Set is imaginary
     *
     * @param bool $isImaginary
     */
    public function setIsImaginary(bool $isImaginary): void
    {
        $this->isImaginary = $isImaginary;
    }

    /**
     * Get geodata
     * 
     * @return Feature|FeatureCollection
     */
    public function getGeodata(): Feature|FeatureCollection
    {
        if ($this->geodata instanceof LazyLoadingProxy) {
            $this->geodata->_loadRealInstance();
        }
        return $this->geodata;
    }

    /**
     * Set geodata
     * 
     * @param Feature|FeatureCollection
     */
    public function setGeodata(Feature|FeatureCollection $geodata): void
    {
        $this->geodata = $geodata;
    }

    /**
     * Get location plan
     * 
     * @return MapResource
     */
    public function getParentLocation(): MapResource
    {
        if ($this->locationPlan instanceof LazyLoadingProxy) {
            $this->locationPlan->_loadRealInstance();
        }
        return $this->locationPlan;
    }

    /**
     * Set location plan
     * 
     * @param MapResource
     */
    public function setParentLocation(MapResource $locationPlan): void
    {
        $this->locationPlan = $locationPlan;
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
     * Get address street
     *
     * @return string
     */
    public function getAddressStreet(): string
    {
        return $this->addressStreet;
    }

    /**
     * Set address street
     *
     * @param string $addressStreet
     */
    public function setAddressStreet(string $addressStreet): void
    {
        $this->addressStreet = $addressStreet;
    }

    /**
     * Get address number
     *
     * @return string
     */
    public function getAddressNumber(): string
    {
        return $this->addressNumber;
    }

    /**
     * Set address number
     *
     * @param string $addressNumber
     */
    public function setAddressNumber(string $addressNumber): void
    {
        $this->addressNumber = $addressNumber;
    }

    /**
     * Get address ZIP
     *
     * @return string
     */
    public function getAddressZip(): string
    {
        return $this->addressZip;
    }

    /**
     * Set address ZIP
     *
     * @param string $addressZip
     */
    public function setAddressZip(string $addressZip): void
    {
        $this->addressZip = $addressZip;
    }

    /**
     * Get address city
     *
     * @return string
     */
    public function getAddressCity(): string
    {
        return $this->addressCity;
    }

    /**
     * Set address city
     *
     * @param string $addressCity
     */
    public function setAddressCity(string $addressCity): void
    {
        $this->addressCity = $addressCity;
    }

    /**
     * Get as location of location relation
     *
     * @return ObjectStorage<LocationRelation>
     */
    public function getAsLocationOfLocationRelation(): ?ObjectStorage
    {
        return $this->asLocationOfLocationRelation;
    }

    /**
     * Set as location of location relation
     *
     * @param ObjectStorage<LocationRelation> $asLocationOfLocationRelation
     */
    public function setAsLocationOfLocationRelation(ObjectStorage $asLocationOfLocationRelation): void
    {
        $this->asLocationOfLocationRelation = $asLocationOfLocationRelation;
    }

    /**
     * Add as location of location relation
     *
     * @param LocationRelation $asLocationOfLocationRelation
     */
    public function addAsLocationOfLocationRelation(LocationRelation $asLocationOfLocationRelation): void
    {
        $this->asLocationOfLocationRelation?->attach($asLocationOfLocationRelation);
    }

    /**
     * Remove as location of location relation
     *
     * @param LocationRelation $asLocationOfLocationRelation
     */
    public function removeAsLocationOfLocationRelation(LocationRelation $asLocationOfLocationRelation): void
    {
        $this->asLocationOfLocationRelation?->detach($asLocationOfLocationRelation);
    }

    /**
     * Remove all as location of location relations
     */
    public function removeAllAsLocationOfLocationRelation(): void
    {
        $asLocationOfLocationRelation = clone $this->asLocationOfLocationRelation;
        $this->asLocationOfLocationRelation->removeAll($asLocationOfLocationRelation);
    }
}
