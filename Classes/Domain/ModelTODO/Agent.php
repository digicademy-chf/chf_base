<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use Digicademy\CHFBib\Domain\Model\Reference;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for agents
 */
class Agent extends AbstractEntity
{
    /**
     * Whether the record should be visible or not
     * 
     * @var bool
     */
    #[Validate([
        'validator' => 'Boolean',
    ])]
    protected bool $hidden = false;

    /**
     * Resource that this agent is attached to
     * 
     * @var LazyLoadingProxy|Resource
     */
    #[Lazy()]
    protected LazyLoadingProxy|Resource $parent_id;

    /**
     * Unique identifier of the agent
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'RegularExpression',
        'options'   => [
            'regularExpression' => '^[0-9a-fA-F]{8}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{12}$',
            'errorMessage'      => 'LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:validator.regularExpression.noUuid',
        ],
    ])]
    protected string $uuid = '';

    /**
     * Specific type of agent
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'person',
                'organisation',
                'otherEntity',
            ],
        ],
    ])]
    protected string $type = '';

    /**
     * Forename of the agent
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $forename = '';

    /**
     * Surname of the agent
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $surname = '';

    /**
     * Single name for the entire corporate body used instead of forename and surname
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $corporateName = '';

    /**
     * Common alternative name that may, for example, be useful as a search term
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $alternativeName = '';

    /**
     * Academic or official title
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $honorific = '';

    /**
     * Name of job or occupation
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $occupation = '';

    /**
     * Social gender of the entity, if available
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'unspecified',
                'female',
                'male',
                'nonBinary',
            ],
        ],
    ])]
    protected string $gender = 'unspecified';

    /**
     * Makes this agent selectable as an author, an editor, a translator, or a further contributor
     * 
     * @var bool
     */
    #[Validate([
        'validator' => 'Boolean',
    ])]
    protected bool $isContributor = false;

    /**
     * Makes this agent available at the top of lists
     * 
     * @var bool
     */
    #[Validate([
        'validator' => 'Boolean',
    ])]
    protected bool $isHighlight = false;

    /**
     * Label to group the agent into
     * 
     * @var ObjectStorage<Tag>
     */
    #[Lazy()]
    protected ObjectStorage $label;

    /**
     * External web address to identify the agent across the web
     * 
     * @var ObjectStorage<SameAs>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $sameAs;

    /**
     * List of authors of this record
     * 
     * @var ObjectStorage<Agent>
     */
    #[Lazy()]
    protected ObjectStorage $author;

    /**
     * List of editors of this record
     * 
     * @var ObjectStorage<Agent>
     */
    #[Lazy()]
    protected ObjectStorage $editor;

    /**
     * List of translators of this record
     * 
     * @var ObjectStorage<Agent>
     */
    #[Lazy()]
    protected ObjectStorage $translator;

    /**
     * List of further contributors to this record
     * 
     * @var ObjectStorage<Agent>
     */
    #[Lazy()]
    protected ObjectStorage $genericContributor;

    /**
     * Date when this record was published
     * 
     * @var DateTime|null
     */
    #[Validate([
        'validator' => 'DateTime',
    ])]
    protected ?DateTime $publicationDate = null;

    /**
     * Number of the current revision of this record
     * 
     * @var int|null
     */
    #[Validate([
        'validator' => 'Number',
    ])]
    protected ?int $revisionNumber = null;

    /**
     * Date when this record was last revised
     * 
     * @var DateTime|null
     */
    #[Validate([
        'validator' => 'DateTime',
    ])]
    protected ?DateTime $revisionDate = null;

    /**
     * Note for internal usage among the editorial team
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 2000,
        ],
    ])]
    protected string $editorialNote = '';

    /**
     * Room for further, less structured content
     * 
     * @var ObjectStorage<ContentElement>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $contentElement;

    /**
     * Images of the agent
     * 
     * @var ObjectStorage<FileReference>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $image;

    /**
     * Additional files for this agent
     * 
     * @var ObjectStorage<FileReference>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $file;

    /**
     * Room to list biographical events
     * 
     * @var ObjectStorage<Period>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $event;

    /**
     * Living agents only have a single start date
     * 
     * @var ObjectStorage<Period>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $lifePeriod;

    /**
     * Place where the agent lives or lived
     * 
     * @var ObjectStorage<Location>
     */
    #[Lazy()]
    protected ObjectStorage $lifeLocation;

    /**
     * Period in which the agent is or was active
     * 
     * @var ObjectStorage<Period>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $activePeriod;

    /**
     * Place in which the agent is or was active
     * 
     * @var ObjectStorage<Location>
     */
    #[Lazy()]
    protected ObjectStorage $activeLocation;

    /**
     * List of bibliographical references for this record
     * 
     * @var ObjectStorage<Reference>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $source;

    /**
     * URI or other identifier of the imported original
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $importOrigin = '';

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
     * List of resources (CHF Base) with this agent as an author
     * 
     * @var ObjectStorage<Resource>
     */
    #[Lazy()]
    protected ObjectStorage $asAuthorOfResource;

    /**
     * List of resources (CHF Base) with this agent as an editor
     * 
     * @var ObjectStorage<Resource>
     */
    #[Lazy()]
    protected ObjectStorage $asEditorOfResource;

    /**
     * List of resources (CHF Base) with this agent as a translator
     * 
     * @var ObjectStorage<Resource>
     */
    #[Lazy()]
    protected ObjectStorage $asTranslatorOfResource;

    /**
     * List of resources (CHF Base) with this agent as a further contributor
     * 
     * @var ObjectStorage<Resource>
     */
    #[Lazy()]
    protected ObjectStorage $asGenericContributorOfResource;

    /**
     * List of agents (CHF Base) with this agent as an author
     * 
     * @var ObjectStorage<Agent>
     */
    #[Lazy()]
    protected ObjectStorage $asAuthorOfAgent;

    /**
     * List of agents (CHF Base) with this agent as an editor
     * 
     * @var ObjectStorage<Agent>
     */
    #[Lazy()]
    protected ObjectStorage $asEditorOfAgent;

    /**
     * List of agents (CHF Base) with this agent as a translator
     * 
     * @var ObjectStorage<Agent>
     */
    #[Lazy()]
    protected ObjectStorage $asTranslatorOfAgent;

    /**
     * List of agents (CHF Base) with this agent as a further contributor
     * 
     * @var ObjectStorage<Agent>
     */
    #[Lazy()]
    protected ObjectStorage $asGenericContributorOfAgent;

    /**
     * List of dates (CHF Base) with this agent as an author
     * 
     * @var ObjectStorage<Period>
     */
    #[Lazy()]
    protected ObjectStorage $asAuthorOfPeriod;

    /**
     * List of dates (CHF Base) with this agent as an editor
     * 
     * @var ObjectStorage<Period>
     */
    #[Lazy()]
    protected ObjectStorage $asEditorOfPeriod;

    /**
     * List of dates (CHF Base) with this agent as a translator
     * 
     * @var ObjectStorage<Period>
     */
    #[Lazy()]
    protected ObjectStorage $asTranslatorOfPeriod;

    /**
     * List of dates (CHF Base) with this agent as a further contributor
     * 
     * @var ObjectStorage<Period>
     */
    #[Lazy()]
    protected ObjectStorage $asGenericContributorOfPeriod;

    /**
     * List of locations (CHF Base) with this agent as an author
     * 
     * @var ObjectStorage<Location>
     */
    #[Lazy()]
    protected ObjectStorage $asAuthorOfLocation;

    /**
     * List of locations (CHF Base) with this agent as an editor
     * 
     * @var ObjectStorage<Location>
     */
    #[Lazy()]
    protected ObjectStorage $asEditorOfLocation;

    /**
     * List of locations (CHF Base) with this agent as a translator
     * 
     * @var ObjectStorage<Location>
     */
    #[Lazy()]
    protected ObjectStorage $asTranslatorOfLocation;

    /**
     * List of locations (CHF Base) with this agent as a further contributor
     * 
     * @var ObjectStorage<Location>
     */
    #[Lazy()]
    protected ObjectStorage $asGenericContributorOfLocation;

    /**
     * Construct object
     *
     * @param Resource $parent_id
     * @param string $uuid
     * @return Agent
     */
    public function __construct(Resource $parent_id, string $uuid)
    {
        $this->initializeObject();

        $this->setParentId($parent_id);
        $this->setUuid($uuid);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->label                          = new ObjectStorage();
        $this->sameAs                         = new ObjectStorage();
        $this->author                         = new ObjectStorage();
        $this->editor                         = new ObjectStorage();
        $this->translator                     = new ObjectStorage();
        $this->genericContributor             = new ObjectStorage();
        $this->contentElement                 = new ObjectStorage();
        $this->image                          = new ObjectStorage();
        $this->file                           = new ObjectStorage();
        $this->event                          = new ObjectStorage();
        $this->lifePeriod                     = new ObjectStorage();
        $this->lifeLocation                   = new ObjectStorage();
        $this->activePeriod                   = new ObjectStorage();
        $this->activeLocation                 = new ObjectStorage();
        $this->source                         = new ObjectStorage();
        $this->asAuthorOfResource             = new ObjectStorage();
        $this->asEditorOfResource             = new ObjectStorage();
        $this->asTranslatorOfResource         = new ObjectStorage();
        $this->asGenericContributorOfResource = new ObjectStorage();
        $this->asAuthorOfAgent                = new ObjectStorage();
        $this->asEditorOfAgent                = new ObjectStorage();
        $this->asTranslatorOfAgent            = new ObjectStorage();
        $this->asGenericContributorOfAgent    = new ObjectStorage();
        $this->asAuthorOfPeriod               = new ObjectStorage();
        $this->asEditorOfPeriod               = new ObjectStorage();
        $this->asTranslatorOfPeriod           = new ObjectStorage();
        $this->asGenericContributorOfPeriod   = new ObjectStorage();
        $this->asAuthorOfLocation             = new ObjectStorage();
        $this->asEditorOfLocation             = new ObjectStorage();
        $this->asTranslatorOfLocation         = new ObjectStorage();
        $this->asGenericContributorOfLocation = new ObjectStorage();
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
     * Get parent ID
     * 
     * @return Resource
     */
    public function getParentId(): Resource
    {
        if ($this->parent_id instanceof LazyLoadingProxy) {
            $this->parent_id->_loadRealInstance();
        }
        return $this->parent_id;
    }

    /**
     * Set parent ID
     * 
     * @param Resource $parent_id
     */
    public function setParentId(Resource $parent_id): void
    {
        $this->parent_id = $parent_id;
    }

    /**
     * Get UUID
     *
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * Set UUID
     *
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }









    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * Set surname
     *
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * Get forename
     *
     * @return string
     */
    public function getForename(): string
    {
        return $this->forename;
    }

    /**
     * Set forename
     *
     * @param string $forename
     */
    public function setForename(string $forename): void
    {
        $this->forename = $forename;
    }

    /**
     * Get corporate name
     *
     * @return string
     */
    public function getCorporateName(): string
    {
        return $this->corporateName;
    }

    /**
     * Set corporate name
     *
     * @param string $corporateName
     */
    public function setCorporateName(string $corporateName): void
    {
        $this->corporateName = $corporateName;
    }

    /**
     * Get label
     *
     * @return ObjectStorage<Tag>
     */
    public function getLabel(): ObjectStorage
    {
        return $this->label;
    }

    /**
     * Set label
     *
     * @param ObjectStorage<Tag> $label
     */
    public function setLabel(ObjectStorage $label): void
    {
        $this->label = $label;
    }

    /**
     * Add label
     *
     * @param Tag $label
     */
    public function addLabel(Tag $label): void
    {
        $this->label->attach($label);
    }

    /**
     * Remove label
     *
     * @param Tag $label
     */
    public function removeLabel(Tag $label): void
    {
        $this->label->detach($label);
    }

    /**
     * Remove all labels
     */
    public function removeAllLabels(): void
    {
        $label = clone $this->label;
        $this->label->removeAll($label);
    }

    /**
     * Get same as
     *
     * @return ObjectStorage<SameAs>
     */
    public function getSameAs(): ObjectStorage
    {
        return $this->sameAs;
    }

    /**
     * Set same as
     *
     * @param ObjectStorage<SameAs> $sameAs
     */
    public function setSameAs(ObjectStorage $sameAs): void
    {
        $this->sameAs = $sameAs;
    }

    /**
     * Add same as
     *
     * @param SameAs $sameAs
     */
    public function addSameAs(SameAs $sameAs): void
    {
        $this->sameAs->attach($sameAs);
    }

    /**
     * Remove same as
     *
     * @param SameAs $sameAs
     */
    public function removeSameAs(SameAs $sameAs): void
    {
        $this->sameAs->detach($sameAs);
    }

    /**
     * Remove all same as
     */
    public function removeAllSameAs(): void
    {
        $sameAs = clone $this->sameAs;
        $this->sameAs->removeAll($sameAs);
    }

    /**
     * Get as author
     *
     * @return ObjectStorage<Entry>
     */
    public function getAsAuthor(): ObjectStorage
    {
        return $this->asAuthor;
    }

    /**
     * Set as author
     *
     * @param ObjectStorage<Entry> $asAuthor
     */
    public function setAsAuthor(ObjectStorage $asAuthor): void
    {
        $this->asAuthor = $asAuthor;
    }

    /**
     * Add as author
     *
     * @param Entry $asAuthor
     */
    public function addAsAuthor(Entry $asAuthor): void
    {
        $this->asAuthor->attach($asAuthor);
    }

    /**
     * Remove as author
     *
     * @param Entry $asAuthor
     */
    public function removeAsAuthor(Entry $asAuthor): void
    {
        $this->asAuthor->detach($asAuthor);
    }

    /**
     * Remove all as authors
     */
    public function removeAllAsAuthors(): void
    {
        $asAuthor = clone $this->asAuthor;
        $this->asAuthor->removeAll($asAuthor);
    }

    /**
     * Get as editor
     *
     * @return ObjectStorage<Entry>
     */
    public function getAsEditor(): ObjectStorage
    {
        return $this->asEditor;
    }

    /**
     * Set as editor
     *
     * @param ObjectStorage<Entry> $asEditor
     */
    public function setAsEditor(ObjectStorage $asEditor): void
    {
        $this->asEditor = $asEditor;
    }

    /**
     * Add as editor
     *
     * @param Entry $asEditor
     */
    public function addAsEditor(Entry $asEditor): void
    {
        $this->asEditor->attach($asEditor);
    }

    /**
     * Remove as editor
     *
     * @param Entry $asEditor
     */
    public function removeAsEditor(Entry $asEditor): void
    {
        $this->asEditor->detach($asEditor);
    }

    /**
     * Remove all as editors
     */
    public function removeAllAsEditors(): void
    {
        $asEditor = clone $this->asEditor;
        $this->asEditor->removeAll($asEditor);
    }







    /**
     * Get as translator
     *
     * @return ObjectStorage<Entry>
     */
    public function getAsTranslator(): ObjectStorage
    {
        return $this->asTranslator;
    }

    /**
     * Set as translator
     *
     * @param ObjectStorage<Entry> $asTranslator
     */
    public function setAsTranslator(ObjectStorage $asTranslator): void
    {
        $this->asTranslator = $asTranslator;
    }

    /**
     * Add as translator
     *
     * @param Entry $asTranslator
     */
    public function addAsTranslator(Entry $asTranslator): void
    {
        $this->asTranslator->attach($asTranslator);
    }

    /**
     * Remove as translator
     *
     * @param Entry $asTranslator
     */
    public function removeAsTranslator(Entry $asTranslator): void
    {
        $this->asTranslator->detach($asTranslator);
    }

    /**
     * Remove all as translators
     */
    public function removeAllAsTranslators(): void
    {
        $asTranslator = clone $this->asTranslator;
        $this->asTranslator->removeAll($asTranslator);
    }

    /**
     * Get as generic contributor
     *
     * @return ObjectStorage<Entry>
     */
    public function getAsGenericContributor(): ObjectStorage
    {
        return $this->asGenericContributor;
    }

    /**
     * Set as generic contributor
     *
     * @param ObjectStorage<Entry> $asGenericContributor
     */
    public function setAsGenericContributor(ObjectStorage $asGenericContributor): void
    {
        $this->asGenericContributor = $asGenericContributor;
    }

    /**
     * Add as generic contributor
     *
     * @param Entry $asGenericContributor
     */
    public function addAsGenericContributor(Entry $asGenericContributor): void
    {
        $this->asGenericContributor->attach($asGenericContributor);
    }

    /**
     * Remove as generic contributor
     *
     * @param Entry $asGenericContributor
     */
    public function removeAsGenericContributor(Entry $asGenericContributor): void
    {
        $this->asGenericContributor->detach($asGenericContributor);
    }

    /**
     * Remove all as generic contributors
     */
    public function removeAllAsGenericContributors(): void
    {
        $asGenericContributor = clone $this->asGenericContributor;
        $this->asGenericContributor->removeAll($asGenericContributor);
    }
}
