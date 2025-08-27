<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model\Traits;

use Digicademy\CHFBase\Domain\Model\AuthorshipRelation;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Trait for models to include an authorship-relation property
 */
trait AuthorshipRelationTrait
{
    /**
     * Authorship of this record
     * 
     * @var ?ObjectStorage<AuthorshipRelation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $authorshipRelation = null;

    /**
     * Get authorship relation
     *
     * @return ObjectStorage<AuthorshipRelation>
     */
    public function getAuthorshipRelation(): ?ObjectStorage
    {
        return $this->authorshipRelation;
    }

    /**
     * Set authorship relation
     *
     * @param ObjectStorage<AuthorshipRelation> $authorshipRelation
     */
    public function setAuthorshipRelation(ObjectStorage $authorshipRelation): void
    {
        $this->authorshipRelation = $authorshipRelation;
    }

    /**
     * Add authorship relation
     *
     * @param AuthorshipRelation $authorshipRelation
     */
    public function addAuthorshipRelation(AuthorshipRelation $authorshipRelation): void
    {
        $this->authorshipRelation?->attach($authorshipRelation);
    }

    /**
     * Remove authorship relation
     *
     * @param AuthorshipRelation $authorshipRelation
     */
    public function removeAuthorshipRelation(AuthorshipRelation $authorshipRelation): void
    {
        $this->authorshipRelation?->detach($authorshipRelation);
    }

    /**
     * Remove all authorship relations
     */
    public function removeAllAuthorshipRelation(): void
    {
        $authorshipRelation = clone $this->authorshipRelation;
        $this->authorshipRelation->removeAll($authorshipRelation);
    }
}
