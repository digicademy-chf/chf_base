<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use Digicademy\CHFBase\Domain\Model\Traits\AgentRelationTrait;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;
use Digicademy\CHFMap\Domain\Model\Traits\CoordinatesTrait;
use Digicademy\CHFMap\Domain\Model\Traits\GeodataTrait;
use Digicademy\CHFObject\Domain\Model\Traits\ObjectGroupTrait;
use Digicademy\CHFObject\Domain\Model\Traits\ObjectTrait;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Attribute\ORM\Cascade;
use TYPO3\CMS\Extbase\Attribute\ORM\Lazy;
use TYPO3\CMS\Extbase\Attribute\Validate;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for AbstractLocation
 */
class AbstractLocation extends AbstractHeritage
{
    use AgentRelationTrait;

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
                'fieldName',
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
     * Map depicting this location
     * 
     * @var FileReference|LazyLoadingProxy|null
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected FileReference|LazyLoadingProxy|null $floorPlan = null;

    /**
     * Room to list more specific locations
     * 
     * @var ObjectStorage<Location>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $location;

    /**
     * Room to list historical events
     * 
     * @var ObjectStorage<Period>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $event;

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
     * Construct object
     *
     * @param string $type
     * @param string $name
     * @return Location
     */
    public function __construct(string $type, string $name)
    {
        parent::__construct();
        $this->initializeObject();

        $this->setType($type);
        $this->setName($name);
        $this->setIri('l');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->location = new ObjectStorage();
        $this->event = new ObjectStorage();
        $this->agentRelation = new ObjectStorage();
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
     * Get floor plan
     * 
     * @return FileReference
     */
    public function getFloorPlan(): FileReference
    {
        if ($this->floorPlan instanceof LazyLoadingProxy) {
            $this->floorPlan->_loadRealInstance();
        }
        return $this->floorPlan;
    }

    /**
     * Set floor plan
     * 
     * @param FileReference
     */
    public function setFloorPlan(FileReference $floorPlan): void
    {
        $this->floorPlan = $floorPlan;
    }

    /**
     * Get location
     *
     * @return ObjectStorage<Location>
     */
    public function getLocation(): ObjectStorage
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
        $this->location->attach($location);
    }

    /**
     * Remove location
     *
     * @param Location $location
     */
    public function removeLocation(Location $location): void
    {
        $this->location->detach($location);
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
}

# If CHF Map and CHF Object are available
if (ExtensionManagementUtility::isLoaded('chf_map') && ExtensionManagementUtility::isLoaded('chf_object')) {

    /**
     * Model for Location (with coordinates, geodata, object, and object-group properties)
     */
    class Location extends AbstractLocation
    {
        use CoordinatesTrait;
        use GeodataTrait;
        use ObjectGroupTrait;
        use ObjectTrait;

        /**
         * Initialize object
         */
        public function initializeObject(): void
        {
            $this->coordinates = new ObjectStorage();
            $this->location = new ObjectStorage();
            $this->object = new ObjectStorage();
            $this->objectGroup = new ObjectStorage();
            $this->event = new ObjectStorage();
            $this->agentRelation = new ObjectStorage();
        }
    }

# If only CHF Map is available
} elseif (ExtensionManagementUtility::isLoaded('chf_map')) {

    /**
     * Model for Location (with coordinates and geodata properties)
     */
    class Location extends AbstractLocation
    {
        use CoordinatesTrait;
        use GeodataTrait;

        /**
         * Initialize object
         */
        public function initializeObject(): void
        {
            $this->coordinates = new ObjectStorage();
            $this->location = new ObjectStorage();
            $this->event = new ObjectStorage();
            $this->agentRelation = new ObjectStorage();
        }
    }

# If only CHF Object is available
} elseif (ExtensionManagementUtility::isLoaded('chf_object')) {

    /**
     * Model for Location (with object and object-group properties)
     */
    class Location extends AbstractLocation
    {
        use ObjectGroupTrait;
        use ObjectTrait;

        /**
         * Initialize object
         */
        public function initializeObject(): void
        {
            $this->location = new ObjectStorage();
            $this->object = new ObjectStorage();
            $this->objectGroup = new ObjectStorage();
            $this->event = new ObjectStorage();
            $this->agentRelation = new ObjectStorage();
        }
    }

# If no relevant extensions are available
} else {

    /**
     * Model for Location
     */
    class Location extends AbstractLocation
    {}
}
