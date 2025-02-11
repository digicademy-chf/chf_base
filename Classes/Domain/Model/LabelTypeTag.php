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
 * Model for LabelTypeTag
 */
class LabelTypeTag extends AbstractTag
{
    /**
     * List of labels that use this label type
     * 
     * @var ?ObjectStorage<LabelTag>
     */
    #[Lazy()]
    protected ?ObjectStorage $asLabelTypeOfLabelTag;

    /**
     * Construct object
     *
     * @param string $text
     * @param string $code
     * @param BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource
     * @param string $iri
     * @param string $uuid
     * @return LabelTypeTag
     */
    public function __construct(string $text, string $code, BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource, string $iri, string $uuid)
    {
        parent::__construct($text, $code, $parentResource, $iri, $uuid);
        $this->initializeObject();

        $this->setType('labelTypeTag');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->asLabelTypeOfLabelTag ??= new ObjectStorage();
    }

    /**
     * Get as label type of label tag
     *
     * @return ObjectStorage<LabelTag>
     */
    public function getAsLabelTypeOfLabelTag(): ?ObjectStorage
    {
        return $this->asLabelTypeOfLabelTag;
    }

    /**
     * Set as label type of label tag
     *
     * @param ObjectStorage<LabelTag> $asLabelTypeOfLabelTag
     */
    public function setAsLabelTypeOfLabelTag(ObjectStorage $asLabelTypeOfLabelTag): void
    {
        $this->asLabelTypeOfLabelTag = $asLabelTypeOfLabelTag;
    }

    /**
     * Add as label type of label tag
     *
     * @param LabelTag $asLabelTypeOfLabelTag
     */
    public function addAsLabelTypeOfLabelTag(LabelTag $asLabelTypeOfLabelTag): void
    {
        $this->asLabelTypeOfLabelTag?->attach($asLabelTypeOfLabelTag);
    }

    /**
     * Remove as label type of label tag
     *
     * @param LabelTag $asLabelTypeOfLabelTag
     */
    public function removeAsLabelTypeOfLabelTag(LabelTag $asLabelTypeOfLabelTag): void
    {
        $this->asLabelTypeOfLabelTag?->detach($asLabelTypeOfLabelTag);
    }

    /**
     * Remove all as label type of label tags
     */
    public function removeAllAsLabelTypeOfLabelTag(): void
    {
        $asLabelTypeOfLabelTag = clone $this->asLabelTypeOfLabelTag;
        $this->asLabelTypeOfLabelTag->removeAll($asLabelTypeOfLabelTag);
    }
}
