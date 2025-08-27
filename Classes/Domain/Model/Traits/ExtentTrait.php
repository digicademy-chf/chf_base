<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model\Traits;

use Digicademy\CHFBase\Domain\Model\Extent;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Trait for models to include an extent property
 */
trait ExtentTrait
{
    /**
     * List of identifiers/dimensions relevant to this entry
     * 
     * @var ?ObjectStorage<Extent>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $extent = null;

    /**
     * Get extent
     *
     * @return ObjectStorage<Extent>
     */
    public function getExtent(): ?ObjectStorage
    {
        return $this->extent;
    }

    /**
     * Set extent
     *
     * @param ObjectStorage<Extent> $extent
     */
    public function setExtent(ObjectStorage $extent): void
    {
        $this->extent = $extent;
    }

    /**
     * Add extent
     *
     * @param Extent $extent
     */
    public function addExtent(Extent $extent): void
    {
        $this->extent?->attach($extent);
    }

    /**
     * Remove extent
     *
     * @param Extent $extent
     */
    public function removeExtent(Extent $extent): void
    {
        $this->extent?->detach($extent);
    }

    /**
     * Remove all extents
     */
    public function removeAllExtent(): void
    {
        $extent = clone $this->extent;
        $this->extent->removeAll($extent);
    }
}
