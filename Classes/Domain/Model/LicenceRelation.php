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
 * Model for LicenceRelation
 */
class LicenceRelation extends AbstractRelation
{
    /**
     * Record to connect a relation to
     * 
     * @var Agent|Location|Period|BibliographicResource|BibliographicEntry|GlossaryResource|LexicographicResource|DictionaryEntry|EncyclopediaEntry|MapResource|Feature|FileGroup|ObjectResource|SingleObject|ObjectGroup|PublicationResource|Essay|Volume|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected Agent|Location|Period|BibliographicResource|BibliographicEntry|GlossaryResource|LexicographicResource|DictionaryEntry|EncyclopediaEntry|MapResource|Feature|FileGroup|ObjectResource|SingleObject|ObjectGroup|PublicationResource|Essay|Volume|null $record = null;

    /**
     * Licences to relate to the record
     * 
     * @var ?ObjectStorage<LicenceTag>
     */
    #[Lazy()]
    protected ?ObjectStorage $licence;

    /**
     * Qualification of this relation
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'allContent',
                'metadata',
                'text',
                'media',
            ],
        ],
    ])]
    protected string $role = 'allContent';

    /**
     * Construct object
     *
     * @param Agent|Location|Period|BibliographicResource|BibliographicEntry|GlossaryResource|LexicographicResource|DictionaryEntry|EncyclopediaEntry|MapResource|Feature|FileGroup|ObjectResource|SingleObject|ObjectGroup|PublicationResource|Essay|Volume $record
     * @param LicenceTag $licence
     * @param BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource
     * @param string $uuid
     * @return LicenceRelation
     */
    public function __construct(Agent|Location|Period|BibliographicResource|BibliographicEntry|GlossaryResource|LexicographicResource|DictionaryEntry|EncyclopediaEntry|MapResource|Feature|FileGroup|ObjectResource|SingleObject|ObjectGroup|PublicationResource|Essay|Volume $record, LicenceTag $licence, BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource, string $uuid)
    {
        parent::__construct($parentResource, $uuid);
        $this->initializeObject();

        $this->setType('licenceRelation');
        $this->setRecord($record);
        $this->addLicence($licence);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->licence ??= new ObjectStorage();
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
     * Get licence
     *
     * @return ObjectStorage<LicenceTag>
     */
    public function getLicence(): ?ObjectStorage
    {
        return $this->licence;
    }

    /**
     * Set licence
     *
     * @param ObjectStorage<LicenceTag> $licence
     */
    public function setLicence(ObjectStorage $licence): void
    {
        $this->licence = $licence;
    }

    /**
     * Add licence
     *
     * @param LicenceTag $licence
     */
    public function addLicence(LicenceTag $licence): void
    {
        $this->licence?->attach($licence);
    }

    /**
     * Remove licence
     *
     * @param LicenceTag $licence
     */
    public function removeLicence(LicenceTag $licence): void
    {
        $this->licence?->detach($licence);
    }

    /**
     * Remove all licences
     */
    public function removeAllLicence(): void
    {
        $licence = clone $this->licence;
        $this->licence->removeAll($licence);
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
