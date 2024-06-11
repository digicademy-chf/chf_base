<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
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
     * @var ?ObjectStorage<object>
     */
    #[Lazy()]
    protected ?ObjectStorage $record;

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
        $this->addRecord($record);
        $this->addLocation($location);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->record ??= new ObjectStorage();
        $this->location ??= new ObjectStorage();
    }

    /**
     * Get record
     *
     * @return ObjectStorage<object>
     */
    public function getRecord(): ?ObjectStorage
    {
        return $this->record;
    }

    /**
     * Set record
     *
     * @param ObjectStorage<object> $record
     */
    public function setRecord(ObjectStorage $record): void
    {
        $this->record = $record;
    }

    /**
     * Add record
     *
     * @param object $record
     */
    public function addRecord(object $record): void
    {
        $this->record?->attach($record);
    }

    /**
     * Remove record
     *
     * @param object $record
     */
    public function removeRecord(object $record): void
    {
        $this->record?->detach($record);
    }

    /**
     * Remove all records
     */
    public function removeAllRecord(): void
    {
        $record = clone $this->record;
        $this->record->removeAll($record);
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
