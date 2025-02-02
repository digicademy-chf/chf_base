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
use Digicademy\CHFMap\Domain\Model\Feature;
use Digicademy\CHFMap\Domain\Model\MapResource;
use Digicademy\CHFObject\Domain\Model\SingleObject;
use Digicademy\CHFObject\Domain\Model\ObjectGroup;
use Digicademy\CHFObject\Domain\Model\ObjectResource;
use Digicademy\CHFPub\Domain\Model\PublicationResource;

defined('TYPO3') or die();

/**
 * Model for Location
 */
class Location extends AbstractHeritage
{
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
     * Feature to use as geodata of this location
     * 
     * @var Feature|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected Feature|LazyLoadingProxy|null $geodata = null;

    /**
     * Map depicting this location
     * 
     * @var MapResource|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected MapResource|LazyLoadingProxy|null $floorPlan = null;

    /**
     * Room to list more specific locations
     * 
     * @var ?ObjectStorage<Location>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $location = null;

    /**
     * Room to list single objects as part of this location
     * 
     * @var ?ObjectStorage<SingleObject>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $object = null;

    /**
     * Room to list object groups as part of this location
     * 
     * @var ?ObjectStorage<ObjectGroup>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $objectGroup = null;

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
     * Larger area that this location is part of
     * 
     * @var Location|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected Location|LazyLoadingProxy|null $parentLocation = null;

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
     * @param string $type
     * @param string $name
     * @param BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource
     * @param string $uuid
     * @return Location
     */
    public function __construct(string $type, string $name, BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource, string $uuid)
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
        $this->location ??= new ObjectStorage();
        $this->object ??= new ObjectStorage();
        $this->objectGroup ??= new ObjectStorage();
        $this->event ??= new ObjectStorage();
        $this->agentRelation ??= new ObjectStorage();
        $this->asLocationOfLocationRelation ??= new ObjectStorage();
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
     * Get geodata
     * 
     * @return Feature
     */
    public function getGeodata(): Feature
    {
        if ($this->geodata instanceof LazyLoadingProxy) {
            $this->geodata->_loadRealInstance();
        }
        return $this->geodata;
    }

    /**
     * Set geodata
     * 
     * @param Feature
     */
    public function setGeodata(Feature $geodata): void
    {
        $this->geodata = $geodata;
    }

    /**
     * Get floor plan
     * 
     * @return MapResource
     */
    public function getFloorPlan(): MapResource
    {
        if ($this->floorPlan instanceof LazyLoadingProxy) {
            $this->floorPlan->_loadRealInstance();
        }
        return $this->floorPlan;
    }

    /**
     * Set floor plan
     * 
     * @param MapResource
     */
    public function setFloorPlan(MapResource $floorPlan): void
    {
        $this->floorPlan = $floorPlan;
    }

    /**
     * Get location
     *
     * @return ObjectStorage<Location>
     */
    public function getLocation(): ?ObjectStorage
    {
        return $this->location;
    }

    /**
     * Set location
     *
     * @param ObjectStorage<Location> $location
     */
    public function setLocation(ObjectStorage $location): void
    {
        $this->location = $location;
    }

    /**
     * Add location
     *
     * @param Location $location
     */
    public function addLocation(Location $location): void
    {
        $this->location?->attach($location);
    }

    /**
     * Remove location
     *
     * @param Location $location
     */
    public function removeLocation(Location $location): void
    {
        $this->location?->detach($location);
    }

    /**
     * Remove all locations
     */
    public function removeAllLocation(): void
    {
        $location = clone $this->location;
        $this->location->removeAll($location);
    }

    /**
     * Get object
     *
     * @return ObjectStorage<SingleObject>
     */
    public function getObject(): ?ObjectStorage
    {
        return $this->object;
    }

    /**
     * Set object
     *
     * @param ObjectStorage<SingleObject> $object
     */
    public function setObject(ObjectStorage $object): void
    {
        $this->object = $object;
    }

    /**
     * Add object
     *
     * @param SingleObject $object
     */
    public function addObject(SingleObject $object): void
    {
        $this->object?->attach($object);
    }

    /**
     * Remove object
     *
     * @param SingleObject $object
     */
    public function removeObject(SingleObject $object): void
    {
        $this->object?->detach($object);
    }

    /**
     * Remove all objects
     */
    public function removeAllObject(): void
    {
        $object = clone $this->object;
        $this->object->removeAll($object);
    }

    /**
     * Get object group
     *
     * @return ObjectStorage<ObjectGroup>
     */
    public function getObjectGroup(): ?ObjectStorage
    {
        return $this->objectGroup;
    }

    /**
     * Set object group
     *
     * @param ObjectStorage<ObjectGroup> $objectGroup
     */
    public function setObjectGroup(ObjectStorage $objectGroup): void
    {
        $this->objectGroup = $objectGroup;
    }

    /**
     * Add object group
     *
     * @param ObjectGroup $objectGroup
     */
    public function addObjectGroup(ObjectGroup $objectGroup): void
    {
        $this->objectGroup?->attach($objectGroup);
    }

    /**
     * Remove object group
     *
     * @param ObjectGroup $objectGroup
     */
    public function removeObjectGroup(ObjectGroup $objectGroup): void
    {
        $this->objectGroup?->detach($objectGroup);
    }

    /**
     * Remove all object groups
     */
    public function removeAllObjectGroup(): void
    {
        $objectGroup = clone $this->objectGroup;
        $this->objectGroup->removeAll($objectGroup);
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
