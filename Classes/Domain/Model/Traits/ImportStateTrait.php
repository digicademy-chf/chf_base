<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model\Traits;

use TYPO3\CMS\Extbase\Attribute\Validate;

defined('TYPO3') or die();

/**
 * Trait for models to include an import-state property
 */
trait ImportStateTrait
{
    /**
     * Brief indicator of the last state that was imported successfully
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $importState = '';

    /**
     * Get import state
     *
     * @return string
     */
    public function getImportState(): string
    {
        return $this->importState;
    }

    /**
     * Set import state
     *
     * @param string $importState
     */
    public function setImportState(string $importState): void
    {
        $this->importState = $importState;
    }
}
