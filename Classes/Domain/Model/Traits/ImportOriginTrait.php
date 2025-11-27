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
 * Trait for models to include an import-origin property
 */
trait ImportOriginTrait
{
    /**
     * URI or other identifier of the imported original
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $importOrigin = '';

    /**
     * Get import origin
     *
     * @return string
     */
    public function getImportOrigin(): string
    {
        return $this->importOrigin;
    }

    /**
     * Set import origin
     *
     * @param string $importOrigin
     */
    public function setImportOrigin(string $importOrigin): void
    {
        $this->importOrigin = $importOrigin;
    }
}
