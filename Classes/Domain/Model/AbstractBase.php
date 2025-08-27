<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use Digicademy\CHFBase\Domain\Model\Traits\AuthorshipRelationTrait;
use Digicademy\CHFBase\Domain\Model\Traits\HiddenTrait;
use Digicademy\CHFBase\Domain\Model\Traits\ImportOriginTrait;
use Digicademy\CHFBase\Domain\Model\Traits\IriTrait;
use Digicademy\CHFBase\Domain\Model\Traits\LicenceRelationTrait;
use Digicademy\CHFBase\Domain\Model\Traits\SameAsTrait;
use Digicademy\CHFBase\Domain\Model\Traits\UuidTrait;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for AbstractBase
 */
class AbstractBase extends AbstractEntity
{
    use AuthorshipRelationTrait;
    use HiddenTrait;
    use ImportOriginTrait;
    use IriTrait;
    use LicenceRelationTrait;
    use SameAsTrait;
    use UuidTrait;

    /**
     * Date of first publication
     * 
     * @var ?\DateTime
     */
    protected ?\DateTime $publicationDate = null;

    /**
     * Date of the last revision
     * 
     * @var ?\DateTime
     */
    protected ?\DateTime $revisionDate = null;

    /**
     * Number of the current revision
     * 
     * @var int
     */
    #[Validate([
        'validator' => 'NumberRange',
        'options' => [
            'minimum' => 1,
        ],
    ])]
    protected int $revisionNumber = 1;

    /**
     * Note for internal usage among the editorial team
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 2000,
        ],
    ])]
    protected string $editorialNote = '';

    /**
     * Construct object
     *
     * @return AbstractBase
     */
    public function __construct()
    {
        $this->initializeObject();
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->sameAs ??= new ObjectStorage();
        $this->authorshipRelation ??= new ObjectStorage();
        $this->licenceRelation ??= new ObjectStorage();
    }

    /**
     * Get publication date
     *
     * @return ?\DateTime
     */
    public function getPublicationDate(): ?\DateTime
    {
        return $this->publicationDate;
    }

    /**
     * Set publication date
     *
     * @param \DateTime $publicationDate
     */
    public function setPublicationDate(\DateTime $publicationDate): void
    {
        $this->publicationDate = $publicationDate;
    }

    /**
     * Get revision date
     *
     * @return ?\DateTime
     */
    public function getRevisionDate(): ?\DateTime
    {
        return $this->revisionDate;
    }

    /**
     * Set revision date
     *
     * @param \DateTime $revisionDate
     */
    public function setRevisionDate(\DateTime $revisionDate): void
    {
        $this->revisionDate = $revisionDate;
    }

    /**
     * Get revision number
     *
     * @return int
     */
    public function getRevisionNumber(): int
    {
        return $this->revisionNumber;
    }

    /**
     * Set revision number
     *
     * @param int $revisionNumber
     */
    public function setRevisionNumber(int $revisionNumber): void
    {
        $this->revisionNumber = $revisionNumber;
    }

    /**
     * Get editorial note
     *
     * @return string
     */
    public function getEditorialNote(): string
    {
        return $this->editorialNote;
    }

    /**
     * Set editorial note
     *
     * @param string $editorialNote
     */
    public function setEditorialNote(string $editorialNote): void
    {
        $this->editorialNote = $editorialNote;
    }
}
