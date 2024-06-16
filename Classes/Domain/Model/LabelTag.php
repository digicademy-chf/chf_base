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
use Digicademy\CHFBib\Domain\Model\BibliographicEntry;
use Digicademy\CHFLex\Domain\Model\DictionaryEntry;
use Digicademy\CHFLex\Domain\Model\EncyclopediaEntry;
use Digicademy\CHFMap\Domain\Model\Feature;
use Digicademy\CHFMedia\Domain\Model\FileGroup;
use Digicademy\CHFObject\Domain\Model\ObjectGroup;
use Digicademy\CHFObject\Domain\Model\SingleObject;
use Digicademy\CHFPub\Domain\Model\Essay;
use Digicademy\CHFPub\Domain\Model\Volume;

defined('TYPO3') or die();

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
     * Category that this label belongs to
     * 
     * @var LabelTypeTag|LazyLoadingProxy
     */
    #[Lazy()]
    protected LabelTypeTag|LazyLoadingProxy $labelType;

    /**
     * List of agents that use this tag as a label
     * 
     * @var ?ObjectStorage<Agent>
     */
    #[Lazy()]
    protected ?ObjectStorage $asLabelOfAgent;

    /**
     * List of locations that use this tag as a label
     * 
     * @var ?ObjectStorage<Location>
     */
    #[Lazy()]
    protected ?ObjectStorage $asLabelOfLocation;

    /**
     * List of periods that use this tag as a label
     * 
     * @var ?ObjectStorage<Period>
     */
    #[Lazy()]
    protected ?ObjectStorage $asLabelOfPeriod;

    /**
     * List of features that use this tag as a label
     * 
     * @var ?ObjectStorage<Feature>
     */
    #[Lazy()]
    protected ?ObjectStorage $asLabelOfFeature;

    /**
     * List of dictionary entries that use this tag as a label
     * 
     * @var ?ObjectStorage<DictionaryEntry>
     */
    #[Lazy()]
    protected ?ObjectStorage $asLabelOfDictionaryEntry;

    /**
     * List of encyclopedia entries that use this tag as a label
     * 
     * @var ?ObjectStorage<EncyclopediaEntry>
     */
    #[Lazy()]
    protected ?ObjectStorage $asLabelOfEncyclopediaEntry;

    /**
     * List of bibliographic entries that use this tag as a label
     * 
     * @var ?ObjectStorage<BibliographicEntry>
     */
    #[Lazy()]
    protected ?ObjectStorage $asLabelOfBibliographicEntry;

    /**
     * List of volumes that use this tag as a label
     * 
     * @var ?ObjectStorage<Volume>
     */
    #[Lazy()]
    protected ?ObjectStorage $asLabelOfVolume;

    /**
     * List of essays that use this tag as a label
     * 
     * @var ?ObjectStorage<Essay>
     */
    #[Lazy()]
    protected ?ObjectStorage $asLabelOfEssay;

    /**
     * List of single objects that use this tag as a label
     * 
     * @var ?ObjectStorage<SingleObject>
     */
    #[Lazy()]
    protected ?ObjectStorage $asLabelOfSingleObject;

    /**
     * List of object groups that use this tag as a label
     * 
     * @var ?ObjectStorage<ObjectGroup>
     */
    #[Lazy()]
    protected ?ObjectStorage $asLabelOfObjectGroup;

    /**
     * List of file groups that use this tag as a label
     * 
     * @var ?ObjectStorage<FileGroup>
     */
    #[Lazy()]
    protected ?ObjectStorage $asLabelOfFileGroup;

    /**
     * Construct object
     *
     * @param object $parentResource
     * @param string $uuid
     * @param string $code
     * @param string $text
     * @return LabelTag
     */
    public function __construct(object $parentResource, string $uuid, string $code, string $text)
    {
        parent::__construct($parentResource, $uuid, $code, $text);
        $this->initializeObject();

        $this->setType('labelTag');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->asLabelOfAgent ??= new ObjectStorage();
        $this->asLabelOfLocation ??= new ObjectStorage();
        $this->asLabelOfPeriod ??= new ObjectStorage();
        $this->asLabelOfFeature ??= new ObjectStorage();
        $this->asLabelOfDictionaryEntry ??= new ObjectStorage();
        $this->asLabelOfEncyclopediaEntry ??= new ObjectStorage();
        $this->asLabelOfBibliographicEntry ??= new ObjectStorage();
        $this->asLabelOfVolume ??= new ObjectStorage();
        $this->asLabelOfEssay ??= new ObjectStorage();
        $this->asLabelOfSingleObject ??= new ObjectStorage();
        $this->asLabelOfObjectGroup ??= new ObjectStorage();
        $this->asLabelOfFileGroup ??= new ObjectStorage();
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
     * Get as label of agent
     *
     * @return ObjectStorage<Agent>
     */
    public function getAsLabelOfAgent(): ?ObjectStorage
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
        $this->asLabelOfAgent?->attach($asLabelOfAgent);
    }

    /**
     * Remove as label of agent
     *
     * @param Agent $asLabelOfAgent
     */
    public function removeAsLabelOfAgent(Agent $asLabelOfAgent): void
    {
        $this->asLabelOfAgent?->detach($asLabelOfAgent);
    }

    /**
     * Remove all as label of agents
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
    public function getAsLabelOfLocation(): ?ObjectStorage
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
        $this->asLabelOfLocation?->attach($asLabelOfLocation);
    }

    /**
     * Remove as label of location
     *
     * @param Location $asLabelOfLocation
     */
    public function removeAsLabelOfLocation(Location $asLabelOfLocation): void
    {
        $this->asLabelOfLocation?->detach($asLabelOfLocation);
    }

    /**
     * Remove all as label of locations
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
    public function getAsLabelOfPeriod(): ?ObjectStorage
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
        $this->asLabelOfPeriod?->attach($asLabelOfPeriod);
    }

    /**
     * Remove as label of period
     *
     * @param Period $asLabelOfPeriod
     */
    public function removeAsLabelOfPeriod(Period $asLabelOfPeriod): void
    {
        $this->asLabelOfPeriod?->detach($asLabelOfPeriod);
    }

    /**
     * Remove all as label of periods
     */
    public function removeAllAsLabelOfPeriod(): void
    {
        $asLabelOfPeriod = clone $this->asLabelOfPeriod;
        $this->asLabelOfPeriod->removeAll($asLabelOfPeriod);
    }

    /**
     * Get as label of feature
     *
     * @return ObjectStorage<Feature>
     */
    public function getAsLabelOfFeature(): ?ObjectStorage
    {
        return $this->asLabelOfFeature;
    }

    /**
     * Set as label of feature
     *
     * @param ObjectStorage<Feature> $asLabelOfFeature
     */
    public function setAsLabelOfFeature(ObjectStorage $asLabelOfFeature): void
    {
        $this->asLabelOfFeature = $asLabelOfFeature;
    }

    /**
     * Add as label of feature
     *
     * @param Feature $asLabelOfFeature
     */
    public function addAsLabelOfFeature(Feature $asLabelOfFeature): void
    {
        $this->asLabelOfFeature?->attach($asLabelOfFeature);
    }

    /**
     * Remove as label of feature
     *
     * @param Feature $asLabelOfFeature
     */
    public function removeAsLabelOfFeature(Feature $asLabelOfFeature): void
    {
        $this->asLabelOfFeature?->detach($asLabelOfFeature);
    }

    /**
     * Remove all as label of features
     */
    public function removeAllAsLabelOfFeature(): void
    {
        $asLabelOfFeature = clone $this->asLabelOfFeature;
        $this->asLabelOfFeature->removeAll($asLabelOfFeature);
    }

    /**
     * Get as label of dictionary entry
     *
     * @return ObjectStorage<DictionaryEntry>
     */
    public function getAsLabelOfDictionaryEntry(): ?ObjectStorage
    {
        return $this->asLabelOfDictionaryEntry;
    }

    /**
     * Set as label of dictionary entry
     *
     * @param ObjectStorage<DictionaryEntry> $asLabelOfDictionaryEntry
     */
    public function setAsLabelOfDictionaryEntry(ObjectStorage $asLabelOfDictionaryEntry): void
    {
        $this->asLabelOfDictionaryEntry = $asLabelOfDictionaryEntry;
    }

    /**
     * Add as label of dictionary entry
     *
     * @param DictionaryEntry $asLabelOfDictionaryEntry
     */
    public function addAsLabelOfDictionaryEntry(DictionaryEntry $asLabelOfDictionaryEntry): void
    {
        $this->asLabelOfDictionaryEntry?->attach($asLabelOfDictionaryEntry);
    }

    /**
     * Remove as label of dictionary entry
     *
     * @param DictionaryEntry $asLabelOfDictionaryEntry
     */
    public function removeAsLabelOfDictionaryEntry(DictionaryEntry $asLabelOfDictionaryEntry): void
    {
        $this->asLabelOfDictionaryEntry?->detach($asLabelOfDictionaryEntry);
    }

    /**
     * Remove all as label of dictionary entries
     */
    public function removeAllAsLabelOfDictionaryEntry(): void
    {
        $asLabelOfDictionaryEntry = clone $this->asLabelOfDictionaryEntry;
        $this->asLabelOfDictionaryEntry->removeAll($asLabelOfDictionaryEntry);
    }

    /**
     * Get as label of encyclopedia entry
     *
     * @return ObjectStorage<EncyclopediaEntry>
     */
    public function getAsLabelOfEncyclopediaEntry(): ?ObjectStorage
    {
        return $this->asLabelOfEncyclopediaEntry;
    }

    /**
     * Set as label of encyclopedia entry
     *
     * @param ObjectStorage<EncyclopediaEntry> $asLabelOfEncyclopediaEntry
     */
    public function setAsLabelOfEncyclopediaEntry(ObjectStorage $asLabelOfEncyclopediaEntry): void
    {
        $this->asLabelOfEncyclopediaEntry = $asLabelOfEncyclopediaEntry;
    }

    /**
     * Add as label of encyclopedia entry
     *
     * @param EncyclopediaEntry $asLabelOfEncyclopediaEntry
     */
    public function addAsLabelOfEncyclopediaEntry(EncyclopediaEntry $asLabelOfEncyclopediaEntry): void
    {
        $this->asLabelOfEncyclopediaEntry?->attach($asLabelOfEncyclopediaEntry);
    }

    /**
     * Remove as label of encyclopedia entry
     *
     * @param EncyclopediaEntry $asLabelOfEncyclopediaEntry
     */
    public function removeAsLabelOfEncyclopediaEntry(EncyclopediaEntry $asLabelOfEncyclopediaEntry): void
    {
        $this->asLabelOfEncyclopediaEntry?->detach($asLabelOfEncyclopediaEntry);
    }

    /**
     * Remove all as label of encyclopedia entries
     */
    public function removeAllAsLabelOfEncyclopediaEntry(): void
    {
        $asLabelOfEncyclopediaEntry = clone $this->asLabelOfEncyclopediaEntry;
        $this->asLabelOfEncyclopediaEntry->removeAll($asLabelOfEncyclopediaEntry);
    }

    /**
     * Get as label of bibliographic entry
     *
     * @return ObjectStorage<BibliographicEntry>
     */
    public function getAsLabelOfBibliographicEntry(): ?ObjectStorage
    {
        return $this->asLabelOfBibliographicEntry;
    }

    /**
     * Set as label of bibliographic entry
     *
     * @param ObjectStorage<BibliographicEntry> $asLabelOfBibliographicEntry
     */
    public function setAsLabelOfBibliographicEntry(ObjectStorage $asLabelOfBibliographicEntry): void
    {
        $this->asLabelOfBibliographicEntry = $asLabelOfBibliographicEntry;
    }

    /**
     * Add as label of bibliographic entry
     *
     * @param BibliographicEntry $asLabelOfBibliographicEntry
     */
    public function addAsLabelOfBibliographicEntry(BibliographicEntry $asLabelOfBibliographicEntry): void
    {
        $this->asLabelOfBibliographicEntry?->attach($asLabelOfBibliographicEntry);
    }

    /**
     * Remove as label of bibliographic entry
     *
     * @param BibliographicEntry $asLabelOfBibliographicEntry
     */
    public function removeAsLabelOfBibliographicEntry(BibliographicEntry $asLabelOfBibliographicEntry): void
    {
        $this->asLabelOfBibliographicEntry?->detach($asLabelOfBibliographicEntry);
    }

    /**
     * Remove all as label of bibliographic entries
     */
    public function removeAllAsLabelOfBibliographicEntry(): void
    {
        $asLabelOfBibliographicEntry = clone $this->asLabelOfBibliographicEntry;
        $this->asLabelOfBibliographicEntry->removeAll($asLabelOfBibliographicEntry);
    }

    /**
     * Get as label of volume
     *
     * @return ObjectStorage<Volume>
     */
    public function getAsLabelOfVolume(): ?ObjectStorage
    {
        return $this->asLabelOfVolume;
    }

    /**
     * Set as label of volume
     *
     * @param ObjectStorage<Volume> $asLabelOfVolume
     */
    public function setAsLabelOfVolume(ObjectStorage $asLabelOfVolume): void
    {
        $this->asLabelOfVolume = $asLabelOfVolume;
    }

    /**
     * Add as label of volume
     *
     * @param Volume $asLabelOfVolume
     */
    public function addAsLabelOfVolume(Volume $asLabelOfVolume): void
    {
        $this->asLabelOfVolume?->attach($asLabelOfVolume);
    }

    /**
     * Remove as label of volume
     *
     * @param Volume $asLabelOfVolume
     */
    public function removeAsLabelOfVolume(Volume $asLabelOfVolume): void
    {
        $this->asLabelOfVolume?->detach($asLabelOfVolume);
    }

    /**
     * Remove all as label of volumes
     */
    public function removeAllAsLabelOfVolume(): void
    {
        $asLabelOfVolume = clone $this->asLabelOfVolume;
        $this->asLabelOfVolume->removeAll($asLabelOfVolume);
    }

    /**
     * Get as label of essay
     *
     * @return ObjectStorage<Essay>
     */
    public function getAsLabelOfEssay(): ?ObjectStorage
    {
        return $this->asLabelOfEssay;
    }

    /**
     * Set as label of essay
     *
     * @param ObjectStorage<Essay> $asLabelOfEssay
     */
    public function setAsLabelOfEssay(ObjectStorage $asLabelOfEssay): void
    {
        $this->asLabelOfEssay = $asLabelOfEssay;
    }

    /**
     * Add as label of essay
     *
     * @param Essay $asLabelOfEssay
     */
    public function addAsLabelOfEssay(Essay $asLabelOfEssay): void
    {
        $this->asLabelOfEssay?->attach($asLabelOfEssay);
    }

    /**
     * Remove as label of essay
     *
     * @param Essay $asLabelOfEssay
     */
    public function removeAsLabelOfEssay(Essay $asLabelOfEssay): void
    {
        $this->asLabelOfEssay?->detach($asLabelOfEssay);
    }

    /**
     * Remove all as label of essays
     */
    public function removeAllAsLabelOfEssay(): void
    {
        $asLabelOfEssay = clone $this->asLabelOfEssay;
        $this->asLabelOfEssay->removeAll($asLabelOfEssay);
    }

    /**
     * Get as label of single object
     *
     * @return ObjectStorage<SingleObject>
     */
    public function getAsLabelOfSingleObject(): ?ObjectStorage
    {
        return $this->asLabelOfSingleObject;
    }

    /**
     * Set as label of single object
     *
     * @param ObjectStorage<SingleObject> $asLabelOfSingleObject
     */
    public function setAsLabelOfSingleObject(ObjectStorage $asLabelOfSingleObject): void
    {
        $this->asLabelOfSingleObject = $asLabelOfSingleObject;
    }

    /**
     * Add as label of single object
     *
     * @param SingleObject $asLabelOfSingleObject
     */
    public function addAsLabelOfSingleObject(SingleObject $asLabelOfSingleObject): void
    {
        $this->asLabelOfSingleObject?->attach($asLabelOfSingleObject);
    }

    /**
     * Remove as label of single object
     *
     * @param SingleObject $asLabelOfSingleObject
     */
    public function removeAsLabelOfSingleObject(SingleObject $asLabelOfSingleObject): void
    {
        $this->asLabelOfSingleObject?->detach($asLabelOfSingleObject);
    }

    /**
     * Remove all as label of single objects
     */
    public function removeAllAsLabelOfSingleObject(): void
    {
        $asLabelOfSingleObject = clone $this->asLabelOfSingleObject;
        $this->asLabelOfSingleObject->removeAll($asLabelOfSingleObject);
    }

    /**
     * Get as label of object group
     *
     * @return ObjectStorage<ObjectGroup>
     */
    public function getAsLabelOfObjectGroup(): ?ObjectStorage
    {
        return $this->asLabelOfObjectGroup;
    }

    /**
     * Set as label of object group
     *
     * @param ObjectStorage<ObjectGroup> $asLabelOfObjectGroup
     */
    public function setAsLabelOfObjectGroup(ObjectStorage $asLabelOfObjectGroup): void
    {
        $this->asLabelOfObjectGroup = $asLabelOfObjectGroup;
    }

    /**
     * Add as label of object group
     *
     * @param ObjectGroup $asLabelOfObjectGroup
     */
    public function addAsLabelOfObjectGroup(ObjectGroup $asLabelOfObjectGroup): void
    {
        $this->asLabelOfObjectGroup?->attach($asLabelOfObjectGroup);
    }

    /**
     * Remove as label of object group
     *
     * @param ObjectGroup $asLabelOfObjectGroup
     */
    public function removeAsLabelOfObjectGroup(ObjectGroup $asLabelOfObjectGroup): void
    {
        $this->asLabelOfObjectGroup?->detach($asLabelOfObjectGroup);
    }

    /**
     * Remove all as label of object groups
     */
    public function removeAllAsLabelOfObjectGroup(): void
    {
        $asLabelOfObjectGroup = clone $this->asLabelOfObjectGroup;
        $this->asLabelOfObjectGroup->removeAll($asLabelOfObjectGroup);
    }

    /**
     * Get as label of file group
     *
     * @return ObjectStorage<FileGroup>
     */
    public function getAsLabelOfFileGroup(): ?ObjectStorage
    {
        return $this->asLabelOfFileGroup;
    }

    /**
     * Set as label of file group
     *
     * @param ObjectStorage<FileGroup> $asLabelOfFileGroup
     */
    public function setAsLabelOfFileGroup(ObjectStorage $asLabelOfFileGroup): void
    {
        $this->asLabelOfFileGroup = $asLabelOfFileGroup;
    }

    /**
     * Add as label of file group
     *
     * @param FileGroup $asLabelOfFileGroup
     */
    public function addAsLabelOfFileGroup(FileGroup $asLabelOfFileGroup): void
    {
        $this->asLabelOfFileGroup?->attach($asLabelOfFileGroup);
    }

    /**
     * Remove as label of file group
     *
     * @param FileGroup $asLabelOfFileGroup
     */
    public function removeAsLabelOfFileGroup(FileGroup $asLabelOfFileGroup): void
    {
        $this->asLabelOfFileGroup?->detach($asLabelOfFileGroup);
    }

    /**
     * Remove all as label of file groups
     */
    public function removeAllAsLabelOfFileGroup(): void
    {
        $asLabelOfFileGroup = clone $this->asLabelOfFileGroup;
        $this->asLabelOfFileGroup->removeAll($asLabelOfFileGroup);
    }
}
