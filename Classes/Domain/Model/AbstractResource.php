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
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Model\AgentRelation;
use Digicademy\CHFBase\Domain\Model\AuthorshipRelation;
use Digicademy\CHFBase\Domain\Model\LabelTag;
use Digicademy\CHFBase\Domain\Model\LabelTypeTag;
use Digicademy\CHFBase\Domain\Model\LicenceRelation;
use Digicademy\CHFBase\Domain\Model\LicenceTag;
use Digicademy\CHFBase\Domain\Model\LinkRelation;
use Digicademy\CHFBase\Domain\Model\LocationRelation;
use Digicademy\CHFBib\Domain\Model\SourceRelation;
use Digicademy\CHFLex\Domain\Model\DefinitionTypeTag;
use Digicademy\CHFLex\Domain\Model\InflectionTypeTag;
use Digicademy\CHFLex\Domain\Model\LexicographicRelation;
use Digicademy\CHFLex\Domain\Model\MemberRoleTag;
use Digicademy\CHFLex\Domain\Model\PartOfSpeechTag;
use Digicademy\CHFLex\Domain\Model\RelationTypeTag;
use Digicademy\CHFLex\Domain\Model\SimilarityRelation;
use Digicademy\CHFLex\Domain\Model\TranscriptionSchemeTag;
use Digicademy\CHFMap\Domain\Model\VariantRelation;
use Digicademy\CHFMedia\Domain\Model\FileGroup;
use Digicademy\CHFPub\Domain\Model\PublicationRelation;

defined('TYPO3') or die();

/**
 * Model for AbstractResource
 */
class AbstractResource extends AbstractBase
{
    /**
     * Type of resource
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
     * Name of this resource
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $title = '';

    /**
     * Language of this resource
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength', # Generic validator because there is no canonical list of allowed options to check against
        'options'   => [
            'minimum' => 1,
        ],
    ])]
    protected string $langCode = '';

    /**
     * Brief statement about this resource
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
     * List of all agents compiled in this resource
     * 
     * @var ?ObjectStorage<Agent>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $allAgents = null;

    /**
     * List of all locations compiled in this resource
     * 
     * @var ?ObjectStorage<Location>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $allLocations = null;

    /**
     * List of all periods compiled in this resource
     * 
     * @var ?ObjectStorage<Period>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $allPeriods = null;

    /**
     * List of all tags compiled in this resource
     * 
     * @var ?ObjectStorage<LabelTag|LabelTypeTag|LicenceTag|DefinitionTypeTag|InflectionTypeTag|MemberRoleTag|PartOfSpeechTag|RelationTypeTag|TranscriptionSchemeTag>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $allTags = null;

    /**
     * List of all keywords compiled in this resource
     * 
     * @var ?ObjectStorage<Keyword>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $allKeywords = null;

    /**
     * List of all relations compiled in this resource
     * 
     * @var ?ObjectStorage<AuthorshipRelation|LocationRelation|AgentRelation|LicenceRelation|LinkRelation|SourceRelation|SimilarityRelation|LexicographicRelation|VariantRelation|PublicationRelation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $allRelations = null;

    /**
     * List of all file collections compiled in this resource
     * 
     * @var ?ObjectStorage<FileGroup>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $allFileGroups = null;

    /**
     * Brief indicator of the last state that was imported successfully
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $importState = '';

    /**
     * Construct object
     *
     * @param string $langCode
     * @param string $uuid
     * @return AbstractResource
     */
    public function __construct(string $langCode, string $uuid)
    {
        parent::__construct($uuid);
        $this->initializeObject();

        $this->setType('0');
        $this->setLangCode($langCode);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->allAgents ??= new ObjectStorage();
        $this->allLocations ??= new ObjectStorage();
        $this->allPeriods ??= new ObjectStorage();
        $this->allTags ??= new ObjectStorage();
        $this->allKeywords ??= new ObjectStorage();
        $this->allRelations ??= new ObjectStorage();
        $this->allFileGroups ??= new ObjectStorage();
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
     * Get title
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setCode(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Get lang code
     *
     * @return string
     */
    public function getLangCode(): string
    {
        return $this->langCode;
    }

    /**
     * Set lang code
     *
     * @param string $langCode
     */
    public function setLangCode(string $langCode): void
    {
        $this->langCode = $langCode;
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
     * Get all agents
     *
     * @return ObjectStorage<Agent>
     */
    public function getAllAgents(): ?ObjectStorage
    {
        return $this->allAgents;
    }

    /**
     * Set all agents
     *
     * @param ObjectStorage<Agent> $allAgents
     */
    public function setAllAgents(ObjectStorage $allAgents): void
    {
        $this->allAgents = $allAgents;
    }

    /**
     * Add all agents
     *
     * @param Agent $allAgents
     */
    public function addAllAgents(Agent $allAgents): void
    {
        $this->allAgents?->attach($allAgents);
    }

    /**
     * Remove all agents
     *
     * @param Agent $allAgents
     */
    public function removeAllAgents(Agent $allAgents): void
    {
        $this->allAgents?->detach($allAgents);
    }

    /**
     * Remove all all agents
     */
    public function removeAllAllAgents(): void
    {
        $allAgents = clone $this->allAgents;
        $this->allAgents->removeAll($allAgents);
    }

    /**
     * Get all locations
     *
     * @return ObjectStorage<Location>
     */
    public function getAllLocations(): ?ObjectStorage
    {
        return $this->allLocations;
    }

    /**
     * Set all locations
     *
     * @param ObjectStorage<Location> $allLocations
     */
    public function setAllLocations(ObjectStorage $allLocations): void
    {
        $this->allLocations = $allLocations;
    }

    /**
     * Add all locations
     *
     * @param Location $allLocations
     */
    public function addAllLocations(Location $allLocations): void
    {
        $this->allLocations?->attach($allLocations);
    }

    /**
     * Remove all locations
     *
     * @param Location $allLocations
     */
    public function removeAllLocations(Location $allLocations): void
    {
        $this->allLocations?->detach($allLocations);
    }

    /**
     * Remove all all locations
     */
    public function removeAllAllLocations(): void
    {
        $allLocations = clone $this->allLocations;
        $this->allLocations->removeAll($allLocations);
    }

    /**
     * Get all periods
     *
     * @return ObjectStorage<Period>
     */
    public function getAllPeriods(): ?ObjectStorage
    {
        return $this->allPeriods;
    }

    /**
     * Set all periods
     *
     * @param ObjectStorage<Period> $allPeriods
     */
    public function setAllPeriods(ObjectStorage $allPeriods): void
    {
        $this->allPeriods = $allPeriods;
    }

    /**
     * Add all periods
     *
     * @param Period $allPeriods
     */
    public function addAllPeriods(Period $allPeriods): void
    {
        $this->allPeriods?->attach($allPeriods);
    }

    /**
     * Remove all periods
     *
     * @param Period $allPeriods
     */
    public function removeAllPeriods(Period $allPeriods): void
    {
        $this->allPeriods?->detach($allPeriods);
    }

    /**
     * Remove all all periods
     */
    public function removeAllAllPeriods(): void
    {
        $allPeriods = clone $this->allPeriods;
        $this->allPeriods->removeAll($allPeriods);
    }

    /**
     * Get all tags
     *
     * @return ObjectStorage<LabelTag|LabelTypeTag|LicenceTag|DefinitionTypeTag|InflectionTypeTag|MemberRoleTag|PartOfSpeechTag|RelationTypeTag|TranscriptionSchemeTag>
     */
    public function getAllTags(): ?ObjectStorage
    {
        return $this->allTags;
    }

    /**
     * Set all tags
     *
     * @param ObjectStorage<LabelTag|LabelTypeTag|LicenceTag|DefinitionTypeTag|InflectionTypeTag|MemberRoleTag|PartOfSpeechTag|RelationTypeTag|TranscriptionSchemeTag> $allTags
     */
    public function setAllTags(ObjectStorage $allTags): void
    {
        $this->allTags = $allTags;
    }

    /**
     * Add all tags
     *
     * @param LabelTag|LabelTypeTag|LicenceTag|DefinitionTypeTag|InflectionTypeTag|MemberRoleTag|PartOfSpeechTag|RelationTypeTag|TranscriptionSchemeTag $allTags
     */
    public function addAllTags(LabelTag|LabelTypeTag|LicenceTag|DefinitionTypeTag|InflectionTypeTag|MemberRoleTag|PartOfSpeechTag|RelationTypeTag|TranscriptionSchemeTag $allTags): void
    {
        $this->allTags?->attach($allTags);
    }

    /**
     * Remove all tags
     *
     * @param LabelTag|LabelTypeTag|LicenceTag|DefinitionTypeTag|InflectionTypeTag|MemberRoleTag|PartOfSpeechTag|RelationTypeTag|TranscriptionSchemeTag $allTags
     */
    public function removeAllTags(LabelTag|LabelTypeTag|LicenceTag|DefinitionTypeTag|InflectionTypeTag|MemberRoleTag|PartOfSpeechTag|RelationTypeTag|TranscriptionSchemeTag $allTags): void
    {
        $this->allTags?->detach($allTags);
    }

    /**
     * Remove all all tags
     */
    public function removeAllAllTags(): void
    {
        $allTags = clone $this->allTags;
        $this->allTags->removeAll($allTags);
    }

    /**
     * Get all keywords
     *
     * @return ObjectStorage<Keyword>
     */
    public function getAllKeywords(): ?ObjectStorage
    {
        return $this->allKeywords;
    }

    /**
     * Set all keywords
     *
     * @param ObjectStorage<Keyword> $allKeywords
     */
    public function setAllKeywords(ObjectStorage $allKeywords): void
    {
        $this->allKeywords = $allKeywords;
    }

    /**
     * Add all keywords
     *
     * @param Keyword $allKeywords
     */
    public function addAllKeywords(Keyword $allKeywords): void
    {
        $this->allKeywords?->attach($allKeywords);
    }

    /**
     * Remove all keywords
     *
     * @param Keyword $allKeywords
     */
    public function removeAllKeywords(Keyword $allKeywords): void
    {
        $this->allKeywords?->detach($allKeywords);
    }

    /**
     * Remove all all keywords
     */
    public function removeAllAllKeywords(): void
    {
        $allKeywords = clone $this->allKeywords;
        $this->allKeywords->removeAll($allKeywords);
    }

    /**
     * Get all relations
     *
     * @return ObjectStorage<AuthorshipRelation|LocationRelation|AgentRelation|LicenceRelation|LinkRelation|SourceRelation|SimilarityRelation|LexicographicRelation|VariantRelation|PublicationRelation>
     */
    public function getAllRelations(): ?ObjectStorage
    {
        return $this->allRelations;
    }

    /**
     * Set all relations
     *
     * @param ObjectStorage<AuthorshipRelation|LocationRelation|AgentRelation|LicenceRelation|LinkRelation|SourceRelation|SimilarityRelation|LexicographicRelation|VariantRelation|PublicationRelation> $allRelations
     */
    public function setAllRelations(ObjectStorage $allRelations): void
    {
        $this->allRelations = $allRelations;
    }

    /**
     * Add all relations
     *
     * @param AuthorshipRelation|LocationRelation|AgentRelation|LicenceRelation|LinkRelation|SourceRelation|SimilarityRelation|LexicographicRelation|VariantRelation|PublicationRelation $allRelations
     */
    public function addAllRelations(AuthorshipRelation|LocationRelation|AgentRelation|LicenceRelation|LinkRelation|SourceRelation|SimilarityRelation|LexicographicRelation|VariantRelation|PublicationRelation $allRelations): void
    {
        $this->allRelations?->attach($allRelations);
    }

    /**
     * Remove all relations
     *
     * @param AuthorshipRelation|LocationRelation|AgentRelation|LicenceRelation|LinkRelation|SourceRelation|SimilarityRelation|LexicographicRelation|VariantRelation|PublicationRelation $allRelations
     */
    public function removeAllRelations(AuthorshipRelation|LocationRelation|AgentRelation|LicenceRelation|LinkRelation|SourceRelation|SimilarityRelation|LexicographicRelation|VariantRelation|PublicationRelation $allRelations): void
    {
        $this->allRelations?->detach($allRelations);
    }

    /**
     * Remove all all relations
     */
    public function removeAllAllRelations(): void
    {
        $allRelations = clone $this->allRelations;
        $this->allRelations->removeAll($allRelations);
    }

    /**
     * Get all file groups
     *
     * @return ObjectStorage<FileGroup>
     */
    public function getAllFileGroups(): ?ObjectStorage
    {
        return $this->allFileGroups;
    }

    /**
     * Set all file groups
     *
     * @param ObjectStorage<FileGroup> $allFileGroups
     */
    public function setAllFileGroups(ObjectStorage $allFileGroups): void
    {
        $this->allFileGroups = $allFileGroups;
    }

    /**
     * Add all file groups
     *
     * @param FileGroup $allFileGroups
     */
    public function addAllFileGroups(FileGroup $allFileGroups): void
    {
        $this->allFileGroups?->attach($allFileGroups);
    }

    /**
     * Remove all file groups
     *
     * @param FileGroup $allFileGroups
     */
    public function removeAllFileGroups(FileGroup $allFileGroups): void
    {
        $this->allFileGroups?->detach($allFileGroups);
    }

    /**
     * Remove all all file groups
     */
    public function removeAllAllFileGroups(): void
    {
        $allFileGroups = clone $this->allFileGroups;
        $this->allFileGroups->removeAll($allFileGroups);
    }

    /**
     * Get import state
     *
     * @return string
     */
    public function getImportState(): string
    {
        return $this->importState;
    }

    /**
     * Set import state
     *
     * @param string $importState
     */
    public function setImportState(string $importState): void
    {
        $this->importState = $importState;
    }
}
