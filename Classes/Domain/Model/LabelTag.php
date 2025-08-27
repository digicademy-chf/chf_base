<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for LabelTag
 */
class LabelTag extends AbstractTag
{
    /**
     * Group of labels that this one belongs to
     * 
     * @var LabelTypeTag|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected LabelTypeTag|LazyLoadingProxy|null $labelType = null;

    /**
     * List of keywords describing this label
     * 
     * @var ?ObjectStorage<Keyword>
     */
    #[Lazy()]
    protected ?ObjectStorage $keyword;

    /**
     * Label that this label is part of
     * 
     * @var LabelTag|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected LabelTag|LazyLoadingProxy|null $parentLabelTag = null;

    /**
     * Construct object
     *
     * @param string $text
     * @return LabelTag
     */
    public function __construct(string $text)
    {
        parent::__construct($text);
        $this->initializeObject();

        $this->setType('labelTag');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->keyword ??= new ObjectStorage();
    }

    /**
     * Get label type
     * 
     * @return LabelTypeTag
     */
    public function getLabelType(): LabelTypeTag
    {
        if ($this->labelType instanceof LazyLoadingProxy) {
            $this->labelType->_loadRealInstance();
        }
        return $this->labelType;
    }

    /**
     * Set label type
     * 
     * @param LabelTypeTag
     */
    public function setLabelType(LabelTypeTag $labelType): void
    {
        $this->labelType = $labelType;
    }

    /**
     * Get keyword
     *
     * @return ObjectStorage<Keyword>
     */
    public function getKeyword(): ?ObjectStorage
    {
        return $this->keyword;
    }

    /**
     * Set keyword
     *
     * @param ObjectStorage<Keyword> $keyword
     */
    public function setKeyword(ObjectStorage $keyword): void
    {
        $this->keyword = $keyword;
    }

    /**
     * Add keyword
     *
     * @param Keyword $keyword
     */
    public function addKeyword(Keyword $keyword): void
    {
        $this->keyword?->attach($keyword);
    }

    /**
     * Remove keyword
     *
     * @param Keyword $keyword
     */
    public function removeKeyword(Keyword $keyword): void
    {
        $this->keyword?->detach($keyword);
    }

    /**
     * Remove all keywords
     */
    public function removeAllKeyword(): void
    {
        $keyword = clone $this->keyword;
        $this->keyword->removeAll($keyword);
    }

    /**
     * Get parent label tag
     * 
     * @return LabelTag
     */
    public function getParentLabelTag(): LabelTag
    {
        if ($this->parentLabelTag instanceof LazyLoadingProxy) {
            $this->parentLabelTag->_loadRealInstance();
        }
        return $this->parentLabelTag;
    }

    /**
     * Set parent label tag
     * 
     * @param LabelTag
     */
    public function setParentLabelTag(LabelTag $parentLabelTag): void
    {
        $this->parentLabelTag = $parentLabelTag;
    }
}
