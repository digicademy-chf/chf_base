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
 * Trait for models to include a UUID property
 */
trait UuidTrait
{
    /**
     * Unique identifier of this record
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'RegularExpression',
        'options' => [
            'regularExpression' => '^[0-9a-fA-F]{8}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{12}$',
            'errorMessage' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:validator.regularExpression.noUuid',
        ],
    ])]
    protected string $uuid; # IRI is usually set automatically by the DataHandler

    /**
     * Get UUID
     *
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * Set UUID
     *
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }
}
