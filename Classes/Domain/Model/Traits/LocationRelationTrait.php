<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model\Traits;

use Digicademy\CHFBase\Domain\Model\LocationRelation;
use TYPO3\CMS\Extbase\Attribute\ORM\Lazy;
use TYPO3\CMS\Extbase\Attribute\ORM\Cascade;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Trait for models to include a location-relation property
 */
trait LocationRelationTrait
{
    /**
     * Location related to this record
     * 
     * @var ObjectStorage<LocationRelation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $locationRelation;

    /**
     * Get location relation
     *
     * @return ObjectStorage<LocationRelation>
     */
    public function getLocationRelation(): ObjectStorage
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
        $this->locationRelation->attach($locationRelation);
    }

    /**
     * Remove location relation
     *
     * @param LocationRelation $locationRelation
     */
    public function removeLocationRelation(LocationRelation $locationRelation): void
    {
        $this->locationRelation->detach($locationRelation);
    }

    /**
     * Remove all location relations
     */
    public function removeAllLocationRelation(): void
    {
        $locationRelation = clone $this->locationRelation;
        $this->locationRelation->removeAll($locationRelation);
    }
}
