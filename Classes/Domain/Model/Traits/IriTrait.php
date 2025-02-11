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
 * Trait for models to include an IRI property
 */
trait IriTrait
{
    /**
     * Site-specific identifier of this record
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'RegularExpression',
        'options' => [
            'regularExpression' => '^[^\s!?\/.*#|]+$',
            'errorMessage' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:validator.regularExpression.noIri',
        ],
    ])]
    protected string $iri; # IRI is usually set automatically by the DataHandler

    /**
     * Get IRI
     *
     * @return string
     */
    public function getIri(): string
    {
        return $this->iri;
    }

    /**
     * Set IRI
     *
     * @param string $iri
     */
    public function setIri(string $iri): void
    {
        $this->iri = $iri;
    }
}
