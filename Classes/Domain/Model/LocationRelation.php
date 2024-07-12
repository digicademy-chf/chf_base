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

defined('TYPO3') or die();

/**
 * Model for LocationRelation
 */
class LocationRelation extends AbstractRelation
{
    /**
     * Record to connect a relation to
     * 
     * @var object|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected object|null $record = null;

    /**
     * Location to relate to the record
     * 
     * @var ?ObjectStorage<Location>
     */
    #[Lazy()]
    protected ?ObjectStorage $location;

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
                'currentLocation',
                'formerLocation',
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
     * @param Location $location
     * @return LocationRelation
     */
    public function __construct(object $parentResource, string $uuid, object $record, Location $location)
    {
        parent::__construct($parentResource, $uuid);
        $this->initializeObject();

        $this->setType('locationRelation');
        $this->setRecord($record);
        $this->addLocation($location);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->location ??= new ObjectStorage();
    }

    /**
     * Get record
     * 
     * @return object
     */
    public function getRecord(): object
    {
        if ($this->record instanceof LazyLoadingProxy) {
            $this->record->_loadRealInstance();
        }
        return $this->record;
    }

    /**
     * Set record
     * 
     * @param object
     */
    public function setRecord(object $record): void
    {
        $this->record = $record;
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
