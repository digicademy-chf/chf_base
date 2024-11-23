<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBib\Domain\Model\BibliographicResource;
use Digicademy\CHFGloss\Domain\Model\GlossaryResource;
use Digicademy\CHFLex\Domain\Model\LexicographicResource;
use Digicademy\CHFMap\Domain\Model\MapResource;
use Digicademy\CHFObject\Domain\Model\ObjectResource;
use Digicademy\CHFPub\Domain\Model\PublicationResource;

defined('TYPO3') or die();

/**
 * Model for LicenceTag
 */
class LicenceTag extends AbstractTag
{
    /**
     * List of licence relations that use this licence
     * 
     * @var ?ObjectStorage<LicenceRelation>
     */
    #[Lazy()]
    protected ?ObjectStorage $asLicenceOfLicenceRelation;

    /**
     * Construct object
     *
     * @param string $text
     * @param string $code
     * @param BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource
     * @param string $uuid
     * @return LicenceTag
     */
    public function __construct(string $text, string $code, BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource, string $uuid)
    {
        parent::__construct($text, $code, $parentResource, $uuid);
        $this->initializeObject();

        $this->setType('licenceTag');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->asLicenceOfLicenceRelation ??= new ObjectStorage();
    }

    /**
     * Get as licence of licence relation
     *
     * @return ObjectStorage<LicenceRelation>
     */
    public function getAsLicenceOfLicenceRelation(): ?ObjectStorage
    {
        return $this->asLicenceOfLicenceRelation;
    }

    /**
     * Set as licence of licence relation
     *
     * @param ObjectStorage<LicenceRelation> $asLicenceOfLicenceRelation
     */
    public function setAsLicenceOfLicenceRelation(ObjectStorage $asLicenceOfLicenceRelation): void
    {
        $this->asLicenceOfLicenceRelation = $asLicenceOfLicenceRelation;
    }

    /**
     * Add as licence of licence relation
     *
     * @param LicenceRelation $asLicenceOfLicenceRelation
     */
    public function addAsLicenceOfLicenceRelation(LicenceRelation $asLicenceOfLicenceRelation): void
    {
        $this->asLicenceOfLicenceRelation?->attach($asLicenceOfLicenceRelation);
    }

    /**
     * Remove as licence of licence relation
     *
     * @param LicenceRelation $asLicenceOfLicenceRelation
     */
    public function removeAsLicenceOfLicenceRelation(LicenceRelation $asLicenceOfLicenceRelation): void
    {
        $this->asLicenceOfLicenceRelation?->detach($asLicenceOfLicenceRelation);
    }

    /**
     * Remove all as licence of licence relations
     */
    public function removeAllAsLicenceOfLicenceRelation(): void
    {
        $asLicenceOfLicenceRelation = clone $this->asLicenceOfLicenceRelation;
        $this->asLicenceOfLicenceRelation->removeAll($asLicenceOfLicenceRelation);
    }
}
