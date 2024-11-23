<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBib\Domain\Model\BibliographicResource;
use Digicademy\CHFBib\Domain\Model\SourceRelation;
use Digicademy\CHFGloss\Domain\Model\GlossaryResource;
use Digicademy\CHFLex\Domain\Model\LexicographicResource;
use Digicademy\CHFMap\Domain\Model\MapResource;
use Digicademy\CHFObject\Domain\Model\ObjectResource;
use Digicademy\CHFPub\Domain\Model\PublicationRelation;
use Digicademy\CHFPub\Domain\Model\PublicationResource;

defined('TYPO3') or die();

/**
 * Model for AbstractHeritage
 */
class AbstractHeritage extends AbstractBase
{
    /**
     * Label to group the database record into
     * 
     * @var ?ObjectStorage<LabelTag>
     */
    #[Lazy()]
    protected ?ObjectStorage $label = null;

    /**
     * Room for page content without a fixed structure
     * 
     * @var ?ObjectStorage<ContentElement>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $contentElement;

    /**
     * Footnotes on content elements
     * 
     * @var ?ObjectStorage<Footnote>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $footnote;

    /**
     * Images and other media attached to this record
     * 
     * @var ?ObjectStorage<FileReference>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $media;

    /**
     * Additional files attached to this record
     * 
     * @var ?ObjectStorage<FileReference>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $file;

    /**
     * Sources of this database record
     * 
     * @var ?ObjectStorage<SourceRelation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $sourceRelation = null;

    /**
     * Links relevant to this database record
     * 
     * @var ?ObjectStorage<LinkRelation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $linkRelation = null;

    /**
     * Relevant text publications in the database
     * 
     * @var ?ObjectStorage<PublicationRelation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $publicationRelation = null;

    /**
     * Lists this record without its content
     * 
     * @var bool
     */
    #[Validate([
        'validator' => 'Boolean',
    ])]
    protected bool $isTeaser = false;

    /**
     * Makes this record available at the top of lists
     * 
     * @var bool
     */
    #[Validate([
        'validator' => 'Boolean',
    ])]
    protected bool $isHighlight = false;

    /**
     * Resource that this database record is part of
     * 
     * @var ?ObjectStorage<BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource>
     */
    #[Lazy()]
    protected ?ObjectStorage $parentResource = null;

    /**
     * Check list for editing this record
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'String',
    ])]
    protected string $editorialSteps = '';

    /**
     * Check list for the publication of this record
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'String',
    ])]
    protected string $publicationSteps = '';

    /**
     * Full import code that this record is based on
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 100000,
        ],
    ])]
    protected string $import = '';

    /**
     * Construct object
     *
     * @param BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource
     * @param string $uuid
     * @return AbstractHeritage
     */
    public function __construct(BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource, string $uuid)
    {
        parent::__construct($uuid);
        $this->initializeObject();

        $this->addParentResource($parentResource);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->label ??= new ObjectStorage();
        $this->contentElement ??= new ObjectStorage();
        $this->footnote ??= new ObjectStorage();
        $this->media ??= new ObjectStorage();
        $this->file ??= new ObjectStorage();
        $this->sourceRelation ??= new ObjectStorage();
        $this->linkRelation ??= new ObjectStorage();
        $this->publicationRelation ??= new ObjectStorage();
        $this->parentResource ??= new ObjectStorage();
    }

    /**
     * Get label
     *
     * @return ObjectStorage<LabelTag>
     */
    public function getLabel(): ?ObjectStorage
    {
        return $this->label;
    }

    /**
     * Set label
     *
     * @param ObjectStorage<LabelTag> $label
     */
    public function setLabel(ObjectStorage $label): void
    {
        $this->label = $label;
    }

    /**
     * Add label
     *
     * @param LabelTag $label
     */
    public function addLabel(LabelTag $label): void
    {
        $this->label?->attach($label);
    }

    /**
     * Remove label
     *
     * @param LabelTag $label
     */
    public function removeLabel(LabelTag $label): void
    {
        $this->label?->detach($label);
    }

    /**
     * Remove all labels
     */
    public function removeAllLabel(): void
    {
        $label = clone $this->label;
        $this->label->removeAll($label);
    }

    /**
     * Get content element
     *
     * @return ObjectStorage<ContentElement>
     */
    public function getContentElement(): ?ObjectStorage
    {
        return $this->contentElement;
    }

    /**
     * Set content element
     *
     * @param ObjectStorage<ContentElement> $contentElement
     */
    public function setContentElement(ObjectStorage $contentElement): void
    {
        $this->contentElement = $contentElement;
    }

    /**
     * Add content element
     *
     * @param ContentElement $contentElement
     */
    public function addContentElement(ContentElement $contentElement): void
    {
        $this->contentElement?->attach($contentElement);
    }

    /**
     * Remove content element
     *
     * @param ContentElement $contentElement
     */
    public function removeContentElement(ContentElement $contentElement): void
    {
        $this->contentElement?->detach($contentElement);
    }

    /**
     * Remove all content elements
     */
    public function removeAllContentElement(): void
    {
        $contentElement = clone $this->contentElement;
        $this->contentElement->removeAll($contentElement);
    }

    /**
     * Get footnote
     *
     * @return ObjectStorage<Footnote>
     */
    public function getFootnote(): ?ObjectStorage
    {
        return $this->footnote;
    }

    /**
     * Set footnote
     *
     * @param ObjectStorage<Footnote> $footnote
     */
    public function setFootnote(ObjectStorage $footnote): void
    {
        $this->footnote = $footnote;
    }

    /**
     * Add footnote
     *
     * @param Footnote $footnote
     */
    public function addFootnote(Footnote $footnote): void
    {
        $this->footnote?->attach($footnote);
    }

    /**
     * Remove footnote
     *
     * @param Footnote $footnote
     */
    public function removeFootnote(Footnote $footnote): void
    {
        $this->footnote?->detach($footnote);
    }

    /**
     * Remove all footnotes
     */
    public function removeAllFootnote(): void
    {
        $footnote = clone $this->footnote;
        $this->footnote->removeAll($footnote);
    }

    /**
     * Get media
     *
     * @return ObjectStorage<FileReference>
     */
    public function getMedia(): ?ObjectStorage
    {
        return $this->media;
    }

    /**
     * Set media
     *
     * @param ObjectStorage<FileReference> $media
     */
    public function setMedia(ObjectStorage $media): void
    {
        $this->media = $media;
    }

    /**
     * Add media
     *
     * @param FileReference $media
     */
    public function addMedia(FileReference $media): void
    {
        $this->media?->attach($media);
    }

    /**
     * Remove media
     *
     * @param FileReference $media
     */
    public function removeMedia(FileReference $media): void
    {
        $this->media?->detach($media);
    }

    /**
     * Remove all media
     */
    public function removeAllMedia(): void
    {
        $media = clone $this->media;
        $this->media->removeAll($media);
    }

    /**
     * Get file
     *
     * @return ObjectStorage<FileReference>
     */
    public function getFile(): ?ObjectStorage
    {
        return $this->file;
    }

    /**
     * Set file
     *
     * @param ObjectStorage<FileReference> $file
     */
    public function setFile(ObjectStorage $file): void
    {
        $this->file = $file;
    }

    /**
     * Add file
     *
     * @param FileReference $file
     */
    public function addFile(FileReference $file): void
    {
        $this->file?->attach($file);
    }

    /**
     * Remove file
     *
     * @param FileReference $file
     */
    public function removeFile(FileReference $file): void
    {
        $this->file?->detach($file);
    }

    /**
     * Remove all files
     */
    public function removeAllFile(): void
    {
        $file = clone $this->file;
        $this->file->removeAll($file);
    }

    /**
     * Get source relation
     *
     * @return ObjectStorage<SourceRelation>
     */
    public function getSourceRelation(): ?ObjectStorage
    {
        return $this->sourceRelation;
    }

    /**
     * Set source relation
     *
     * @param ObjectStorage<SourceRelation> $sourceRelation
     */
    public function setSourceRelation(ObjectStorage $sourceRelation): void
    {
        $this->sourceRelation = $sourceRelation;
    }

    /**
     * Add source relation
     *
     * @param SourceRelation $sourceRelation
     */
    public function addSourceRelation(SourceRelation $sourceRelation): void
    {
        $this->sourceRelation?->attach($sourceRelation);
    }

    /**
     * Remove source relation
     *
     * @param SourceRelation $sourceRelation
     */
    public function removeSourceRelation(SourceRelation $sourceRelation): void
    {
        $this->sourceRelation?->detach($sourceRelation);
    }

    /**
     * Remove all source relations
     */
    public function removeAllSourceRelation(): void
    {
        $sourceRelation = clone $this->sourceRelation;
        $this->sourceRelation->removeAll($sourceRelation);
    }

    /**
     * Get link relation
     *
     * @return ObjectStorage<LinkRelation>
     */
    public function getLinkRelation(): ?ObjectStorage
    {
        return $this->linkRelation;
    }

    /**
     * Set link relation
     *
     * @param ObjectStorage<LinkRelation> $linkRelation
     */
    public function setLinkRelation(ObjectStorage $linkRelation): void
    {
        $this->linkRelation = $linkRelation;
    }

    /**
     * Add link relation
     *
     * @param LinkRelation $linkRelation
     */
    public function addLinkRelation(LinkRelation $linkRelation): void
    {
        $this->linkRelation?->attach($linkRelation);
    }

    /**
     * Remove link relation
     *
     * @param LinkRelation $linkRelation
     */
    public function removeLinkRelation(LinkRelation $linkRelation): void
    {
        $this->linkRelation?->detach($linkRelation);
    }

    /**
     * Remove all link relations
     */
    public function removeAllLinkRelation(): void
    {
        $linkRelation = clone $this->linkRelation;
        $this->linkRelation->removeAll($linkRelation);
    }

    /**
     * Get publication relation
     *
     * @return ObjectStorage<PublicationRelation>
     */
    public function getPublicationRelation(): ?ObjectStorage
    {
        return $this->publicationRelation;
    }

    /**
     * Set publication relation
     *
     * @param ObjectStorage<PublicationRelation> $publicationRelation
     */
    public function setPublicationRelation(ObjectStorage $publicationRelation): void
    {
        $this->publicationRelation = $publicationRelation;
    }

    /**
     * Add publication relation
     *
     * @param PublicationRelation $publicationRelation
     */
    public function addPublicationRelation(PublicationRelation $publicationRelation): void
    {
        $this->publicationRelation?->attach($publicationRelation);
    }

    /**
     * Remove publication relation
     *
     * @param PublicationRelation $publicationRelation
     */
    public function removePublicationRelation(PublicationRelation $publicationRelation): void
    {
        $this->publicationRelation?->detach($publicationRelation);
    }

    /**
     * Remove all publication relations
     */
    public function removeAllPublicationRelation(): void
    {
        $publicationRelation = clone $this->publicationRelation;
        $this->publicationRelation->removeAll($publicationRelation);
    }

    /**
     * Get is teaser
     *
     * @return bool
     */
    public function getIsTeaser(): bool
    {
        return $this->isTeaser;
    }

    /**
     * Set is teaser
     *
     * @param bool $isTeaser
     */
    public function setIsTeaser(bool $isTeaser): void
    {
        $this->isTeaser = $isTeaser;
    }

    /**
     * Get is highlight
     *
     * @return bool
     */
    public function getIsHighlight(): bool
    {
        return $this->isHighlight;
    }

    /**
     * Set is highlight
     *
     * @param bool $isHighlight
     */
    public function setIsHighlight(bool $isHighlight): void
    {
        $this->isHighlight = $isHighlight;
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
     * Get editorial steps
     *
     * @return string
     */
    public function getEditorialSteps(): string
    {
        return $this->editorialSteps;
    }

    /**
     * Set editorial steps
     *
     * @param string $editorialSteps
     */
    public function setEditorialSteps(string $editorialSteps): void
    {
        $this->editorialSteps = $editorialSteps;
    }

    /**
     * Get publication steps
     *
     * @return string
     */
    public function getPublicationSteps(): string
    {
        return $this->publicationSteps;
    }

    /**
     * Set publication steps
     *
     * @param string $publicationSteps
     */
    public function setPublicationSteps(string $publicationSteps): void
    {
        $this->publicationSteps = $publicationSteps;
    }

    /**
     * Get import
     *
     * @return string
     */
    public function getImport(): string
    {
        return $this->import;
    }

    /**
     * Set import
     *
     * @param string $import
     */
    public function setImport(string $import): void
    {
        $this->import = $import;
    }
}
