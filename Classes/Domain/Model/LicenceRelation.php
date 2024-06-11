<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for LicenceRelation
 */
class LicenceRelation extends AbstractRelation
{
    /**
     * Record to connect a relation to
     * 
     * @var ?ObjectStorage<object>
     */
    #[Lazy()]
    protected ?ObjectStorage $record;

    /**
     * Licence to relate to the record
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
                '0',
                'allContent',
                'metadata',
                'text',
                'media',
            ],
        ],
    ])]
    protected string $role = '0';

    /**
     * Construct object
     *
     * @param object $parentResource
     * @param string $uuid
     * @param object $record
     * @param LicenceTag $licence
     * @return LicenceRelation
     */
    public function __construct(object $parentResource, string $uuid, object $record, LicenceTag $licence)
    {
        parent::__construct($parentResource, $uuid);
        $this->initializeObject();

        $this->setType('licenceRelation');
        $this->addRecord($record);
        $this->addLicence($licence);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->record ??= new ObjectStorage();
        $this->licence ??= new ObjectStorage();
    }

    /**
     * Get record
     *
     * @return ObjectStorage<object>
     */
    public function getRecord(): ?ObjectStorage
    {
        return $this->record;
    }

    /**
     * Set record
     *
     * @param ObjectStorage<object> $record
     */
    public function setRecord(ObjectStorage $record): void
    {
        $this->record = $record;
    }

    /**
     * Add record
     *
     * @param object $record
     */
    public function addRecord(object $record): void
    {
        $this->record?->attach($record);
    }

    /**
     * Remove record
     *
     * @param object $record
     */
    public function removeRecord(object $record): void
    {
        $this->record?->detach($record);
    }

    /**
     * Remove all records
     */
    public function removeAllRecord(): void
    {
        $record = clone $this->record;
        $this->record->removeAll($record);
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
