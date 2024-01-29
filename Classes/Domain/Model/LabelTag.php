<?php
defined('TYPO3') or die();
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Model for LabelTag
 */
class LabelTag extends AbstractTag
{
    /**
     * Label that this label is part of
     * 
     * @var LabelTag|LazyLoadingProxy
     */
    #[Lazy()]
    protected LabelTag|LazyLoadingProxy $parentLabelTag;

    /**
     * Categorisation of this label
     * 
     * @var ObjectStorage<LabelTypeTag>
     */
    #[Lazy()]
    protected ObjectStorage $labelType;

    /**
     * List of agents that use this tag as a label
     * 
     * @var ObjectStorage<Agent>
     */
    #[Lazy()]
    protected ObjectStorage $asLabelOfAgent;

    /**
     * List of locations that use this tag as a label
     * 
     * @var ObjectStorage<Location>
     */
    #[Lazy()]
    protected ObjectStorage $asLabelOfLocation;

    /**
     * List of periods that use this tag as a label
     * 
     * @var ObjectStorage<Period>
     */
    #[Lazy()]
    protected ObjectStorage $asLabelOfPeriod;

    /**
     * Construct object
     *
     * @param string $uuid
     * @param string $code
     * @param string $text
     * @return LabelTag
     */
    public function __construct(string $uuid, string $code, string $text)
    {
        parent::__construct($uuid, $code, $text);
        $this->initializeObject();

        $this->setType('labelTag');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->parentLabelTag = new LazyLoadingProxy();
        $this->labelType = new ObjectStorage();
        $this->asLabelOfAgent = new ObjectStorage();
        $this->asLabelOfLocation = new ObjectStorage();
        $this->asLabelOfPeriod = new ObjectStorage();
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

    /**
     * Get label type
     *
     * @return ObjectStorage<LabelTypeTag>
     */
    public function getLabelType(): ObjectStorage
    {
        return $this->labelType;
    }

    /**
     * Set label type
     *
     * @param ObjectStorage<LabelTypeTag> $labelType
     */
    public function setLabelType(ObjectStorage $labelType): void
    {
        $this->labelType = $labelType;
    }

    /**
     * Add label type
     *
     * @param LabelTypeTag $labelType
     */
    public function addLabelType(LabelTypeTag $labelType): void
    {
        $this->labelType->attach($labelType);
    }

    /**
     * Remove label type
     *
     * @param LabelTypeTag $labelType
     */
    public function removeLabelType(LabelTypeTag $labelType): void
    {
        $this->labelType->detach($labelType);
    }

    /**
     * Remove all label type
     */
    public function removeAllLabelType(): void
    {
        $labelType = clone $this->labelType;
        $this->labelType->removeAll($labelType);
    }

    /**
     * Get as label of agent
     *
     * @return ObjectStorage<Agent>
     */
    public function getAsLabelOfAgent(): ObjectStorage
    {
        return $this->asLabelOfAgent;
    }

    /**
     * Set as label of agent
     *
     * @param ObjectStorage<Agent> $asLabelOfAgent
     */
    public function setAsLabelOfAgent(ObjectStorage $asLabelOfAgent): void
    {
        $this->asLabelOfAgent = $asLabelOfAgent;
    }

    /**
     * Add as label of agent
     *
     * @param Agent $asLabelOfAgent
     */
    public function addAsLabelOfAgent(Agent $asLabelOfAgent): void
    {
        $this->asLabelOfAgent->attach($asLabelOfAgent);
    }

    /**
     * Remove as label of agent
     *
     * @param Agent $asLabelOfAgent
     */
    public function removeAsLabelOfAgent(Agent $asLabelOfAgent): void
    {
        $this->asLabelOfAgent->detach($asLabelOfAgent);
    }

    /**
     * Remove all as label of agent
     */
    public function removeAllAsLabelOfAgent(): void
    {
        $asLabelOfAgent = clone $this->asLabelOfAgent;
        $this->asLabelOfAgent->removeAll($asLabelOfAgent);
    }

    /**
     * Get as label of location
     *
     * @return ObjectStorage<Location>
     */
    public function getAsLabelOfLocation(): ObjectStorage
    {
        return $this->asLabelOfLocation;
    }

    /**
     * Set as label of location
     *
     * @param ObjectStorage<Location> $asLabelOfLocation
     */
    public function setAsLabelOfLocation(ObjectStorage $asLabelOfLocation): void
    {
        $this->asLabelOfLocation = $asLabelOfLocation;
    }

    /**
     * Add as label of location
     *
     * @param Location $asLabelOfLocation
     */
    public function addAsLabelOfLocation(Location $asLabelOfLocation): void
    {
        $this->asLabelOfLocation->attach($asLabelOfLocation);
    }

    /**
     * Remove as label of location
     *
     * @param Location $asLabelOfLocation
     */
    public function removeAsLabelOfLocation(Location $asLabelOfLocation): void
    {
        $this->asLabelOfLocation->detach($asLabelOfLocation);
    }

    /**
     * Remove all as label of location
     */
    public function removeAllAsLabelOfLocation(): void
    {
        $asLabelOfLocation = clone $this->asLabelOfLocation;
        $this->asLabelOfLocation->removeAll($asLabelOfLocation);
    }

    /**
     * Get as label of period
     *
     * @return ObjectStorage<Period>
     */
    public function getAsLabelOfPeriod(): ObjectStorage
    {
        return $this->asLabelOfPeriod;
    }

    /**
     * Set as label of period
     *
     * @param ObjectStorage<Period> $asLabelOfPeriod
     */
    public function setAsLabelOfPeriod(ObjectStorage $asLabelOfPeriod): void
    {
        $this->asLabelOfPeriod = $asLabelOfPeriod;
    }

    /**
     * Add as label of period
     *
     * @param Period $asLabelOfPeriod
     */
    public function addAsLabelOfPeriod(Period $asLabelOfPeriod): void
    {
        $this->asLabelOfPeriod->attach($asLabelOfPeriod);
    }

    /**
     * Remove as label of period
     *
     * @param Period $asLabelOfPeriod
     */
    public function removeAsLabelOfPeriod(Period $asLabelOfPeriod): void
    {
        $this->asLabelOfPeriod->detach($asLabelOfPeriod);
    }

    /**
     * Remove all as label of period
     */
    public function removeAllAsLabelOfPeriod(): void
    {
        $asLabelOfPeriod = clone $this->asLabelOfPeriod;
        $this->asLabelOfPeriod->removeAll($asLabelOfPeriod);
    }
}

?>
