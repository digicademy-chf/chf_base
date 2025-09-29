<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use Digicademy\CHFBase\Domain\Model\Traits\ImportTrait;
use Digicademy\CHFBase\Domain\Model\Traits\IsHighlightTrait;
use Digicademy\CHFBase\Domain\Model\Traits\IsTeaserTrait;
use Digicademy\CHFBase\Domain\Model\Traits\LabelTrait;
use Digicademy\CHFBase\Domain\Model\Traits\LinkRelationTrait;
use Digicademy\CHFBase\Domain\Model\Traits\ParentResourceTrait;
use Digicademy\CHFBib\Domain\Model\Traits\SourceRelationTrait;
use Digicademy\CHFPub\Domain\Model\Traits\PublicationRelationTrait;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for AbstractAbstractHeritage
 */
class AbstractAbstractHeritage extends AbstractBase
{
    use ImportTrait;
    use IsHighlightTrait;
    use IsTeaserTrait;
    use LabelTrait;
    use LinkRelationTrait;
    use ParentResourceTrait;

    /**
     * Room for page content without a fixed structure
     * 
     * @var ObjectStorage<ContentElement>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $contentElement;

    /**
     * Footnotes on content elements
     * 
     * @var ObjectStorage<Footnote>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $footnote;

    /**
     * Images and other media attached to this record
     * 
     * @var ObjectStorage<FileReference>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $media;

    /**
     * Additional files attached to this record
     * 
     * @var ObjectStorage<FileReference>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $file;

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
     * Construct object
     *
     * @return AbstractHeritage
     */
    public function __construct()
    {
        parent::__construct();
        $this->initializeObject();
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->label = new ObjectStorage();
        $this->contentElement = new ObjectStorage();
        $this->footnote = new ObjectStorage();
        $this->media = new ObjectStorage();
        $this->file = new ObjectStorage();
        $this->linkRelation = new ObjectStorage();
        $this->parentResource = new ObjectStorage();
    }

    /**
     * Get content element
     *
     * @return ObjectStorage<ContentElement>
     */
    public function getContentElement(): ObjectStorage
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
        $this->contentElement->attach($contentElement);
    }

    /**
     * Remove content element
     *
     * @param ContentElement $contentElement
     */
    public function removeContentElement(ContentElement $contentElement): void
    {
        $this->contentElement->detach($contentElement);
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
    public function getFootnote(): ObjectStorage
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
        $this->footnote->attach($footnote);
    }

    /**
     * Remove footnote
     *
     * @param Footnote $footnote
     */
    public function removeFootnote(Footnote $footnote): void
    {
        $this->footnote->detach($footnote);
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
    public function getMedia(): ObjectStorage
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
        $this->media->attach($media);
    }

    /**
     * Remove media
     *
     * @param FileReference $media
     */
    public function removeMedia(FileReference $media): void
    {
        $this->media->detach($media);
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
    public function getFile(): ObjectStorage
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
        $this->file->attach($file);
    }

    /**
     * Remove file
     *
     * @param FileReference $file
     */
    public function removeFile(FileReference $file): void
    {
        $this->file->detach($file);
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
}

# If CHF Bib and CHF Pub are available
if (ExtensionManagementUtility::isLoaded('chf_bib') && ExtensionManagementUtility::isLoaded('chf_pub')) {

    /**
     * Model for AbstractHeritage (with source-relation and publication-relation properties)
     */
    class AbstractHeritage extends AbstractAbstractHeritage
    {
        use PublicationRelationTrait;
        use SourceRelationTrait;

        /**
         * Initialize object
         */
        public function initializeObject(): void
        {
            $this->label = new ObjectStorage();
            $this->contentElement = new ObjectStorage();
            $this->footnote = new ObjectStorage();
            $this->media = new ObjectStorage();
            $this->file = new ObjectStorage();
            $this->sourceRelation = new ObjectStorage();
            $this->linkRelation = new ObjectStorage();
            $this->publicationRelation = new ObjectStorage();
        }
    }

# If only CHF Bib is available
} elseif (ExtensionManagementUtility::isLoaded('chf_bib')) {

    /**
     * Model for AbstractHeritage (with source-relation property)
     */
    class AbstractHeritage extends AbstractAbstractHeritage
    {
        use SourceRelationTrait;

        /**
         * Initialize object
         */
        public function initializeObject(): void
        {
            $this->label = new ObjectStorage();
            $this->contentElement = new ObjectStorage();
            $this->footnote = new ObjectStorage();
            $this->media = new ObjectStorage();
            $this->file = new ObjectStorage();
            $this->sourceRelation = new ObjectStorage();
            $this->linkRelation = new ObjectStorage();
        }
    }

# If only CHF Pub is available
} elseif (ExtensionManagementUtility::isLoaded('chf_pub')) {

    /**
     * Model for AbstractHeritage (with publication-relation property)
     */
    class AbstractHeritage extends AbstractAbstractHeritage
    {
        use PublicationRelationTrait;

        /**
         * Initialize object
         */
        public function initializeObject(): void
        {
            $this->label = new ObjectStorage();
            $this->contentElement = new ObjectStorage();
            $this->footnote = new ObjectStorage();
            $this->media = new ObjectStorage();
            $this->file = new ObjectStorage();
            $this->linkRelation = new ObjectStorage();
            $this->publicationRelation = new ObjectStorage();
        }
    }

# If no relevant extensions are available
} else {

    /**
     * Model for AbstractHeritage
     */
    class AbstractHeritage extends AbstractAbstractHeritage
    {}
}
