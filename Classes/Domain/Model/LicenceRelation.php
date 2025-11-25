<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use Digicademy\CHFBase\Domain\Model\Traits\RecordTrait;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;
use Digicademy\CHFBib\Domain\Model\BibliographicEntry;
use Digicademy\CHFGloss\Domain\Model\GlossaryEntry;
use Digicademy\CHFLex\Domain\Model\DictionaryEntry;
use Digicademy\CHFLex\Domain\Model\EncyclopediaEntry;
use Digicademy\CHFMap\Domain\Model\Feature;
use Digicademy\CHFMedia\Domain\Model\FileGroup;
use Digicademy\CHFObject\Domain\Model\SingleObject;
use Digicademy\CHFObject\Domain\Model\ObjectGroup;
use Digicademy\CHFPub\Domain\Model\Essay;
use Digicademy\CHFPub\Domain\Model\Volume;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for LicenceRelation
 */
class LicenceRelation extends AbstractRelation
{
    use RecordTrait;

    /**
     * Licences to relate to the record
     * 
     * @var ObjectStorage<LicenceTag>
     */
    #[Lazy()]
    protected ObjectStorage $licence;

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
     * @param AbstractResource|Agent|Location|Period|BibliographicEntry|GlossaryEntry|DictionaryEntry|EncyclopediaEntry|Feature|FileGroup|SingleObject|ObjectGroup|Essay|Volume $record
     * @param LicenceTag $licence
     * @return LicenceRelation
     */
    public function __construct(AbstractResource|Agent|Location|Period|BibliographicEntry|GlossaryEntry|DictionaryEntry|EncyclopediaEntry|Feature|FileGroup|SingleObject|ObjectGroup|Essay|Volume $record, LicenceTag $licence)
    {
        parent::__construct();
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
        $this->licence = new ObjectStorage();
    }

    /**
     * Get licence
     *
     * @return ObjectStorage<LicenceTag>
     */
    public function getLicence(): ObjectStorage
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
        $this->licence->attach($licence);
    }

    /**
     * Remove licence
     *
     * @param LicenceTag $licence
     */
    public function removeLicence(LicenceTag $licence): void
    {
        $this->licence->detach($licence);
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
