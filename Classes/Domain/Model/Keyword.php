<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

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
 * Model for Keyword
 */
class Keyword extends AbstractEntity
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
     * Title of this keyword
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'String',
    ])]
    protected string $text = '';

    /**
     * Resource that this database record is part of
     * 
     * @var ?ObjectStorage<BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource>
     */
    #[Lazy()]
    protected ?ObjectStorage $parentResource = null;

    /**
     * List of labels that use this keyword
     * 
     * @var ?ObjectStorage<LabelTag>
     */
    #[Lazy()]
    protected ?ObjectStorage $asKeywordOfLabelTag;

    /**
     * Construct object
     *
     * @param string $text
     * @param BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource
     * @return Keyword
     */
    public function __construct(string $text, BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource)
    {
        $this->initializeObject();

        $this->setText($text);
        $this->addParentResource($parentResource);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->parentResource ??= new ObjectStorage();
        $this->asKeywordOfLabelTag ??= new ObjectStorage();
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
     * Get text
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Set text
     *
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
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

    /**
     * Get as keyword of label tag
     *
     * @return ObjectStorage<LabelTag>
     */
    public function getAsKeywordOfLabelTag(): ?ObjectStorage
    {
        return $this->asKeywordOfLabelTag;
    }

    /**
     * Set as keyword of label tag
     *
     * @param ObjectStorage<LabelTag> $asKeywordOfLabelTag
     */
    public function setAsKeywordOfLabelTag(ObjectStorage $asKeywordOfLabelTag): void
    {
        $this->asKeywordOfLabelTag = $asKeywordOfLabelTag;
    }

    /**
     * Add as keyword of label tag
     *
     * @param LabelTag $asKeywordOfLabelTag
     */
    public function addAsKeywordOfLabelTag(LabelTag $asKeywordOfLabelTag): void
    {
        $this->asKeywordOfLabelTag?->attach($asKeywordOfLabelTag);
    }

    /**
     * Remove as keyword of label tag
     *
     * @param LabelTag $asKeywordOfLabelTag
     */
    public function removeAsKeywordOfLabelTag(LabelTag $asKeywordOfLabelTag): void
    {
        $this->asKeywordOfLabelTag?->detach($asKeywordOfLabelTag);
    }

    /**
     * Remove all as keyword of label tags
     */
    public function removeAllAsKeywordOfLabelTag(): void
    {
        $asKeywordOfLabelTag = clone $this->asKeywordOfLabelTag;
        $this->asKeywordOfLabelTag->removeAll($asKeywordOfLabelTag);
    }
}
