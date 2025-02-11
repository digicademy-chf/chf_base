<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;
use Digicademy\CHFBib\Domain\Model\BibliographicEntry;
use Digicademy\CHFBib\Domain\Model\BibliographicResource;
use Digicademy\CHFGloss\Domain\Model\GlossaryResource;
use Digicademy\CHFLex\Domain\Model\DictionaryEntry;
use Digicademy\CHFLex\Domain\Model\EncyclopediaEntry;
use Digicademy\CHFLex\Domain\Model\LexicographicResource;
use Digicademy\CHFMap\Domain\Model\Feature;
use Digicademy\CHFMap\Domain\Model\MapResource;
use Digicademy\CHFMedia\Domain\Model\FileGroup;
use Digicademy\CHFObject\Domain\Model\ObjectGroup;
use Digicademy\CHFObject\Domain\Model\ObjectResource;
use Digicademy\CHFObject\Domain\Model\SingleObject;
use Digicademy\CHFPub\Domain\Model\Essay;
use Digicademy\CHFPub\Domain\Model\PublicationResource;
use Digicademy\CHFPub\Domain\Model\Volume;

defined('TYPO3') or die();

/**
 * Model for AuthorshipRelation
 */
class AuthorshipRelation extends AbstractRelation
{
    /**
     * Record to connect a relation to
     * 
     * @var Agent|Location|Period|BibliographicResource|BibliographicEntry|GlossaryResource|LexicographicResource|DictionaryEntry|EncyclopediaEntry|MapResource|Feature|FileGroup|ObjectResource|SingleObject|ObjectGroup|PublicationResource|Essay|Volume|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected Agent|Location|Period|BibliographicResource|BibliographicEntry|GlossaryResource|LexicographicResource|DictionaryEntry|EncyclopediaEntry|MapResource|Feature|FileGroup|ObjectResource|SingleObject|ObjectGroup|PublicationResource|Essay|Volume|null $record = null;

    /**
     * Contributors to relate to the record
     * 
     * @var ?ObjectStorage<Agent>
     */
    #[Lazy()]
    protected ?ObjectStorage $contributor;

    /**
     * Qualification of this relation
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'author',
                'editor',
                'translator',
                'contributor',
            ],
        ],
    ])]
    protected string $role = 'author';

    /**
     * Construct object
     *
     * @param Agent|Location|Period|BibliographicResource|BibliographicEntry|GlossaryResource|LexicographicResource|DictionaryEntry|EncyclopediaEntry|MapResource|Feature|FileGroup|ObjectResource|SingleObject|ObjectGroup|PublicationResource|Essay|Volume $record
     * @param Agent $contributor
     * @param BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource
     * @return AuthorshipRelation
     */
    public function __construct(Agent|Location|Period|BibliographicResource|BibliographicEntry|GlossaryResource|LexicographicResource|DictionaryEntry|EncyclopediaEntry|MapResource|Feature|FileGroup|ObjectResource|SingleObject|ObjectGroup|PublicationResource|Essay|Volume $record, Agent $contributor, BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource)
    {
        parent::__construct($parentResource);
        $this->initializeObject();

        $this->setType('authorshipRelation');
        $this->setRecord($record);
        $this->addContributor($contributor);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->contributor ??= new ObjectStorage();
    }

    /**
     * Get record
     * 
     * @return Agent|Location|Period|BibliographicResource|BibliographicEntry|GlossaryResource|LexicographicResource|DictionaryEntry|EncyclopediaEntry|MapResource|Feature|FileGroup|ObjectResource|SingleObject|ObjectGroup|PublicationResource|Essay|Volume
     */
    public function getRecord(): Agent|Location|Period|BibliographicResource|BibliographicEntry|GlossaryResource|LexicographicResource|DictionaryEntry|EncyclopediaEntry|MapResource|Feature|FileGroup|ObjectResource|SingleObject|ObjectGroup|PublicationResource|Essay|Volume
    {
        if ($this->record instanceof LazyLoadingProxy) {
            $this->record->_loadRealInstance();
        }
        return $this->record;
    }

    /**
     * Set record
     * 
     * @param Agent|Location|Period|BibliographicResource|BibliographicEntry|GlossaryResource|LexicographicResource|DictionaryEntry|EncyclopediaEntry|MapResource|Feature|FileGroup|ObjectResource|SingleObject|ObjectGroup|PublicationResource|Essay|Volume
     */
    public function setRecord(Agent|Location|Period|BibliographicResource|BibliographicEntry|GlossaryResource|LexicographicResource|DictionaryEntry|EncyclopediaEntry|MapResource|Feature|FileGroup|ObjectResource|SingleObject|ObjectGroup|PublicationResource|Essay|Volume $record): void
    {
        $this->record = $record;
    }

    /**
     * Get contributor
     *
     * @return ObjectStorage<Agent>
     */
    public function getContributor(): ?ObjectStorage
    {
        return $this->contributor;
    }

    /**
     * Set contributor
     *
     * @param ObjectStorage<Agent> $contributor
     */
    public function setContributor(ObjectStorage $contributor): void
    {
        $this->contributor = $contributor;
    }

    /**
     * Add contributor
     *
     * @param Agent $contributor
     */
    public function addContributor(Agent $contributor): void
    {
        $this->contributor?->attach($contributor);
    }

    /**
     * Remove contributor
     *
     * @param Agent $contributor
     */
    public function removeContributor(Agent $contributor): void
    {
        $this->contributor?->detach($contributor);
    }

    /**
     * Remove all contributors
     */
    public function removeAllContributor(): void
    {
        $contributor = clone $this->contributor;
        $this->contributor->removeAll($contributor);
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * Set role
     *
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }
}
