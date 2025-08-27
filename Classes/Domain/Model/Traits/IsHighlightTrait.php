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
 * Trait for models to include an is-highlight property
 */
trait IsHighlightTrait
{
    /**
     * Makes this record available at the top of lists
     * 
     * @var bool
     */
    #[Validate([
        'validator' => 'Boolean',
    ])]
    protected bool $isHighlight = false;

    /**
     * Get is highlight
     *
     * @return bool
     */
    public function getIsHighlight(): bool
    {
        return $this->isHighlight;
    }

    /**
     * Set is highlight
     *
     * @param bool $isHighlight
     */
    public function setIsHighlight(bool $isHighlight): void
    {
        $this->isHighlight = $isHighlight;
    }
}
