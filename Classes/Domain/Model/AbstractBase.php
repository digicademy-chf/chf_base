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
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for AbstractBase
 */
class AbstractBase extends AbstractEntity
{
    /**
     * Record visible or not
     * 
     * @var bool
     */
    #[Validate([
        'validator' => 'Boolean',
    ])]
    protected bool $hidden = true;

    /**
     * Unique identifier of this record
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'RegularExpression',
        'options' => [
            'regularExpression' => '^[0-9a-fA-F]{8}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{12}$',
            'errorMessage' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:validator.regularExpression.noUuid',
        ],
    ])]
    protected string $uuid = '';

    /**
     * Authoritative web address to identify an entity across the web
     * 
     * @var ?ObjectStorage<SameAs>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $sameAs = null;

    /**
     * Date of first publication
     * 
     * @var ?\DateTime
     */
    protected ?\DateTime $publicationDate = null;

    /**
     * Date of the last revision
     * 
     * @var ?\DateTime
     */
    protected ?\DateTime $revisionDate = null;

    /**
     * Number of the current revision
     * 
     * @var int
     */
    #[Validate([
        'validator' => 'NumberRange',
        'options' => [
            'minimum' => 1,
        ],
    ])]
    protected int $revisionNumber = 1;

    /**
     * Note for internal usage among the editorial team
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 2000,
        ],
    ])]
    protected string $editorialNote = '';

    /**
     * Authorship of this record
     * 
     * @var ?ObjectStorage<AuthorshipRelation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $authorshipRelation = null;

    /**
     * Licence of this record (individual override)
     * 
     * @var ?ObjectStorage<LicenceRelation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $licenceRelation = null;

    /**
     * URI or other identifier of the imported original
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $importOrigin = '';

    /**
     * Construct object
     *
     * @param string $uuid
     * @return AbstractBase
     */
    public function __construct(string $uuid)
    {
        $this->initializeObject();

        $this->setUuid($uuid);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->sameAs ??= new ObjectStorage();
        $this->authorshipRelation ??= new ObjectStorage();
        $this->licenceRelation ??= new ObjectStorage();
    }

    /**
     * Get hidden
     *
     * @return bool
     */
    public function getHidden(): bool
    {
        return $this->hidden;
    }

    /**
     * Set hidden
     *
     * @param bool $hidden
     */
    public function setHidden(bool $hidden): void
    {
        $this->hidden = $hidden;
    }

    /**
     * Get UUID
     *
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * Set UUID
     *
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * Get same as
     *
     * @return ObjectStorage<SameAs>
     */
    public function getSameAs(): ?ObjectStorage
    {
        return $this->sameAs;
    }

    /**
     * Set same as
     *
     * @param ObjectStorage<SameAs> $sameAs
     */
    public function setSameAs(ObjectStorage $sameAs): void
    {
        $this->sameAs = $sameAs;
    }

    /**
     * Add same as
     *
     * @param SameAs $sameAs
     */
    public function addSameAs(SameAs $sameAs): void
    {
        $this->sameAs?->attach($sameAs);
    }

    /**
     * Remove same as
     *
     * @param SameAs $sameAs
     */
    public function removeSameAs(SameAs $sameAs): void
    {
        $this->sameAs?->detach($sameAs);
    }

    /**
     * Remove all same as
     */
    public function removeAllSameAs(): void
    {
        $sameAs = clone $this->sameAs;
        $this->sameAs->removeAll($sameAs);
    }

    /**
     * Get publication date
     *
     * @return ?\DateTime
     */
    public function getPublicationDate(): ?\DateTime
    {
        return $this->publicationDate;
    }

    /**
     * Set publication date
     *
     * @param \DateTime $publicationDate
     */
    public function setPublicationDate(\DateTime $publicationDate): void
    {
        $this->publicationDate = $publicationDate;
    }

    /**
     * Get revision date
     *
     * @return ?\DateTime
     */
    public function getRevisionDate(): ?\DateTime
    {
        return $this->revisionDate;
    }

    /**
     * Set revision date
     *
     * @param \DateTime $revisionDate
     */
    public function setRevisionDate(\DateTime $revisionDate): void
    {
        $this->revisionDate = $revisionDate;
    }

    /**
     * Get revision number
     *
     * @return int
     */
    public function getRevisionNumber(): int
    {
        return $this->revisionNumber;
    }

    /**
     * Set revision number
     *
     * @param int $revisionNumber
     */
    public function setRevisionNumber(int $revisionNumber): void
    {
        $this->revisionNumber = $revisionNumber;
    }

    /**
     * Get editorial note
     *
     * @return string
     */
    public function getEditorialNote(): string
    {
        return $this->editorialNote;
    }

    /**
     * Set editorial note
     *
     * @param string $editorialNote
     */
    public function setEditorialNote(string $editorialNote): void
    {
        $this->editorialNote = $editorialNote;
    }

    /**
     * Get authorship relation
     *
     * @return ObjectStorage<AuthorshipRelation>
     */
    public function getAuthorshipRelation(): ?ObjectStorage
    {
        return $this->authorshipRelation;
    }

    /**
     * Set authorship relation
     *
     * @param ObjectStorage<AuthorshipRelation> $authorshipRelation
     */
    public function setAuthorshipRelation(ObjectStorage $authorshipRelation): void
    {
        $this->authorshipRelation = $authorshipRelation;
    }

    /**
     * Add authorship relation
     *
     * @param AuthorshipRelation $authorshipRelation
     */
    public function addAuthorshipRelation(AuthorshipRelation $authorshipRelation): void
    {
        $this->authorshipRelation?->attach($authorshipRelation);
    }

    /**
     * Remove authorship relation
     *
     * @param AuthorshipRelation $authorshipRelation
     */
    public function removeAuthorshipRelation(AuthorshipRelation $authorshipRelation): void
    {
        $this->authorshipRelation?->detach($authorshipRelation);
    }

    /**
     * Remove all authorship relations
     */
    public function removeAllAuthorshipRelation(): void
    {
        $authorshipRelation = clone $this->authorshipRelation;
        $this->authorshipRelation->removeAll($authorshipRelation);
    }

    /**
     * Get licence relation
     *
     * @return ObjectStorage<LicenceRelation>
     */
    public function getLicenceRelation(): ?ObjectStorage
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
        $this->licenceRelation?->attach($licenceRelation);
    }

    /**
     * Remove licence relation
     *
     * @param LicenceRelation $licenceRelation
     */
    public function removeLicenceRelation(LicenceRelation $licenceRelation): void
    {
        $this->licenceRelation?->detach($licenceRelation);
    }

    /**
     * Remove all licence relations
     */
    public function removeAllLicenceRelation(): void
    {
        $licenceRelation = clone $this->licenceRelation;
        $this->licenceRelation->removeAll($licenceRelation);
    }

    /**
     * Get import origin
     *
     * @return string
     */
    public function getImportOrigin(): string
    {
        return $this->importOrigin;
    }

    /**
     * Set import origin
     *
     * @param string $importOrigin
     */
    public function setImportOrigin(string $importOrigin): void
    {
        $this->importOrigin = $importOrigin;
    }
}
