<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model\Traits;

use Digicademy\CHFBase\Domain\Model\LinkRelation;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Trait for models to include a link-relation property
 */
trait LinkRelationTrait
{
    /**
     * Links relevant to this database record
     * 
     * @var ObjectStorage<LinkRelation>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $linkRelation;

    /**
     * Get link relation
     *
     * @return ObjectStorage<LinkRelation>
     */
    public function getLinkRelation(): ObjectStorage
    {
        return $this->linkRelation;
    }

    /**
     * Set link relation
     *
     * @param ObjectStorage<LinkRelation> $linkRelation
     */
    public function setLinkRelation(ObjectStorage $linkRelation): void
    {
        $this->linkRelation = $linkRelation;
    }

    /**
     * Add link relation
     *
     * @param LinkRelation $linkRelation
     */
    public function addLinkRelation(LinkRelation $linkRelation): void
    {
        $this->linkRelation->attach($linkRelation);
    }

    /**
     * Remove link relation
     *
     * @param LinkRelation $linkRelation
     */
    public function removeLinkRelation(LinkRelation $linkRelation): void
    {
        $this->linkRelation->detach($linkRelation);
    }

    /**
     * Remove all link relations
     */
    public function removeAllLinkRelation(): void
    {
        $linkRelation = clone $this->linkRelation;
        $this->linkRelation->removeAll($linkRelation);
    }
}
