<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model\Traits;

use Digicademy\CHFBase\Domain\Model\LicenceRelation;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Trait for models to include a licence-relation property
 */
trait LicenceRelationTrait
{

    /**
     * Licence of this record (individual override)
     * 
     * @var ObjectStorage<LicenceRelation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $licenceRelation;

    /**
     * Get licence relation
     *
     * @return ObjectStorage<LicenceRelation>
     */
    public function getLicenceRelation(): ObjectStorage
    {
        return $this->licenceRelation;
    }

    /**
     * Set licence relation
     *
     * @param ObjectStorage<LicenceRelation> $licenceRelation
     */
    public function setLicenceRelation(ObjectStorage $licenceRelation): void
    {
        $this->licenceRelation = $licenceRelation;
    }

    /**
     * Add licence relation
     *
     * @param LicenceRelation $licenceRelation
     */
    public function addLicenceRelation(LicenceRelation $licenceRelation): void
    {
        $this->licenceRelation->attach($licenceRelation);
    }

    /**
     * Remove licence relation
     *
     * @param LicenceRelation $licenceRelation
     */
    public function removeLicenceRelation(LicenceRelation $licenceRelation): void
    {
        $this->licenceRelation->detach($licenceRelation);
    }

    /**
     * Remove all licence relations
     */
    public function removeAllLicenceRelation(): void
    {
        $licenceRelation = clone $this->licenceRelation;
        $this->licenceRelation->removeAll($licenceRelation);
    }
}
