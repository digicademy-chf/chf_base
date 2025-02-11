<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use Digicademy\CHFBase\Domain\Model\Traits\IriTrait;
use Digicademy\CHFBase\Domain\Model\Traits\UuidTrait;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBib\Domain\Model\BibliographicResource;
use Digicademy\CHFGloss\Domain\Model\GlossaryResource;
use Digicademy\CHFLex\Domain\Model\LexicographicResource;
use Digicademy\CHFMap\Domain\Model\MapResource;
use Digicademy\CHFObject\Domain\Model\ObjectResource;
use Digicademy\CHFPub\Domain\Model\PublicationResource;

defined('TYPO3') or die();

/**
 * Model for AbstractRelation
 */
class AbstractRelation extends AbstractEntity
{
    use IriTrait;
    use UuidTrait;

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
     * Type of relation
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength', # Validates for string length instead of string values to allow other models to add further types
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $type = '';

    /**
     * Brief statement about this relation
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 2000,
        ],
    ])]
    protected string $description = '';

    /**
     * Resource that this database record is part of
     * 
     * @var ?ObjectStorage<BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource>
     */
    #[Lazy()]
    protected ?ObjectStorage $parentResource = null;

    /**
     * Construct object
     *
     * @param BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource
     * @return AbstractRelation
     */
    public function __construct(BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource)
    {
        $this->initializeObject();

        $this->setType('0');
        $this->addParentResource($parentResource);
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
     * Get description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->parentResource ??= new ObjectStorage();
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
     * Get parent resource
     *
     * @return ObjectStorage<BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource>
     */
    public function getParentResource(): ?ObjectStorage
    {
        return $this->parentResource;
    }

    /**
     * Set parent resource
     *
     * @param ObjectStorage<BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource> $parentResource
     */
    public function setParentResource(ObjectStorage $parentResource): void
    {
        $this->parentResource = $parentResource;
    }

    /**
     * Add parent resource
     *
     * @param BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource
     */
    public function addParentResource(BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource): void
    {
        $this->parentResource?->attach($parentResource);
    }

    /**
     * Remove parent resource
     *
     * @param BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource
     */
    public function removeParentResource(BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource): void
    {
        $this->parentResource?->detach($parentResource);
    }

    /**
     * Remove all parent resources
     */
    public function removeAllParentResource(): void
    {
        $parentResource = clone $this->parentResource;
        $this->parentResource->removeAll($parentResource);
    }
}
