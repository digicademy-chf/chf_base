<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model\Traits;

use Digicademy\CHFBase\Domain\Model\AbstractResource;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Trait for models to include a parent-resource property
 */
trait ParentResourceTrait
{
    /**
     * Resource that this database record is part of
     * 
     * @var ObjectStorage<AbstractResource>
     */
    #[Lazy()]
    protected ObjectStorage $parentResource;

    /**
     * Get parent resource
     *
     * @return ObjectStorage<AbstractResource>
     */
    public function getParentResource(): ObjectStorage
    {
        return $this->parentResource;
    }

    /**
     * Set parent resource
     *
     * @param ObjectStorage<AbstractResource> $parentResource
     */
    public function setParentResource(ObjectStorage $parentResource): void
    {
        $this->parentResource = $parentResource;
    }

    /**
     * Add parent resource
     *
     * @param AbstractResource $parentResource
     */
    public function addParentResource(AbstractResource $parentResource): void
    {
        $this->parentResource->attach($parentResource);
    }

    /**
     * Remove parent resource
     *
     * @param AbstractResource $parentResource
     */
    public function removeParentResource(AbstractResource $parentResource): void
    {
        $this->parentResource->detach($parentResource);
    }

    /**
     * Remove all parent resources
     */
    public function removeAllParentResource(): void
    {
        $parentResource = clone $this->parentResource;
        $this->parentResource->removeAll($parentResource);
    }
}
