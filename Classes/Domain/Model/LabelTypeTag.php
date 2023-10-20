<?php

declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for LabelTypeTag
 */
class LabelTypeTag extends AbstractTag
{
    /**
     * List of labels that use this tag as a label type
     * 
     * @var ObjectStorage<LabelTag>
     */
    #[Lazy()]
    protected ObjectStorage $asLabelTypeOfLabelTag;

    /**
     * Construct object
     *
     * @param string $uuid
     * @param string $code
     * @param string $text
     * @return LabelTypeTag
     */
    public function __construct(string $uuid, string $code, string $text)
    {
        $this->initializeObject();

        parent::__construct($uuid, 'labelTypeTag', $code, $text);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->asLabelTypeOfLabelTag = new ObjectStorage();
    }

    /**
     * Get as label type of label tag
     *
     * @return ObjectStorage<LabelTag>
     */
    public function getAsLabelTypeOfLabelTag(): ObjectStorage
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
        $this->asLabelTypeOfLabelTag->attach($asLabelTypeOfLabelTag);
    }

    /**
     * Remove as label type of label tag
     *
     * @param LabelTag $asLabelTypeOfLabelTag
     */
    public function removeAsLabelTypeOfLabelTag(LabelTag $asLabelTypeOfLabelTag): void
    {
        $this->asLabelTypeOfLabelTag->detach($asLabelTypeOfLabelTag);
    }

    /**
     * Remove all as label type of label tag
     */
    public function removeAllAsLabelTypeOfLabelTag(): void
    {
        $asLabelTypeOfLabelTag = clone $this->asLabelTypeOfLabelTag;
        $this->asLabelTypeOfLabelTag->removeAll($asLabelTypeOfLabelTag);
    }
}

?>
