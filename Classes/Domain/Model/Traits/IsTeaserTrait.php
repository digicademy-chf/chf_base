<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model\Traits;

use TYPO3\CMS\Extbase\Annotation\Validate;

defined('TYPO3') or die();

/**
 * Trait for models to include an is-teaser property
 */
trait IsTeaserTrait
{
    /**
     * Lists this record without its content
     * 
     * @var bool
     */
    #[Validate([
        'validator' => 'Boolean',
    ])]
    protected bool $isTeaser = false;

    /**
     * Get is teaser
     *
     * @return bool
     */
    public function getIsTeaser(): bool
    {
        return $this->isTeaser;
    }

    /**
     * Set is teaser
     *
     * @param bool $isTeaser
     */
    public function setIsTeaser(bool $isTeaser): void
    {
        $this->isTeaser = $isTeaser;
    }
}
