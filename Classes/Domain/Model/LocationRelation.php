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
use Digicademy\CHFLex\Domain\Model\Frequency;
use Digicademy\CHFLex\Domain\Model\LexicographicResource;
use Digicademy\CHFMap\Domain\Model\MapResource;
use Digicademy\CHFMedia\Domain\Model\FileGroup;
use Digicademy\CHFObject\Domain\Model\SingleObject;
use Digicademy\CHFObject\Domain\Model\ObjectGroup;
use Digicademy\CHFObject\Domain\Model\ObjectResource;
use Digicademy\CHFPub\Domain\Model\PublicationResource;

defined('TYPO3') or die();

/**
 * Model for LocationRelation
 */
class LocationRelation extends AbstractRelation
{
    /**
     * Record to connect a relation to
     * 
     * @var Agent|Period|Example|Frequency|FileGroup|SingleObject|ObjectGroup|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected Agent|Period|Example|Frequency|FileGroup|SingleObject|ObjectGroup|null $record = null;

    /**
     * Locations to relate to the record
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
                'genericLocation',
                'originLocation',
                'formerLocation',
                'birthPlace',
                'workPlace',
                'deathPlace',
            ],
        ],
    ])]
    protected string $role = 'genericLocation';

    /**
     * Construct object
     *
     * @param Agent|Period|Example|Frequency|FileGroup|SingleObject|ObjectGroup $record
     * @param Location $location
     * @param BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource
     * @param string $iri
     * @param string $uuid
     * @return LocationRelation
     */
    public function __construct(Agent|Period|Example|Frequency|FileGroup|SingleObject|ObjectGroup $record, Location $location, BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource, string $iri, string $uuid)
    {
        parent::__construct($parentResource, $iri, $uuid);
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
     * @return Agent|Period|Example|Frequency|FileGroup|SingleObject|ObjectGroup
     */
    public function getRecord(): Agent|Period|Example|Frequency|FileGroup|SingleObject|ObjectGroup
    {
        if ($this->record instanceof LazyLoadingProxy) {
            $this->record->_loadRealInstance();
        }
        return $this->record;
    }

    /**
     * Set record
     * 
     * @param Agent|Period|Example|Frequency|FileGroup|SingleObject|ObjectGroup
     */
    public function setRecord(Agent|Period|Example|Frequency|FileGroup|SingleObject|ObjectGroup $record): void
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
