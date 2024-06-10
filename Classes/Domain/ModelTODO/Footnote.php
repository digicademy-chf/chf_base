<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

defined('TYPO3') or die();

/**
 * Model for Footnote
 */
class Footnote extends AbstractEntity
{
    /**
     * Whether the record should be visible or not
     * 
     * @var bool
     */
    #[Validate([
        'validator' => 'Boolean',
    ])]
    protected bool $hidden = false;

    /**
     * Unique identifier of the database record
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'RegularExpression',
        'options' => [
            'regularExpression' => '^[0-9a-fA-F]{8}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{12}$',
            'errorMessage' => 'LLL:EXT:da_base/Resources/Private/Language/locallang.xlf:validator.regularExpression.noUuid',
        ],
    ])]
    protected string $uuid = '';

    /**
     * Content of the footnote
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'String',
    ])]
    protected string $text = '';

    /**
     * Construct object
     *
     * @param string $uuid
     * @param string $text
     * @return Footnote
     */
    public function __construct(string $uuid, string $text)
    {
        $this->setUuid($uuid);
        $this->setText($text);
    }

    /**
     * Get hidden
     *
     * @return bool
     */
    public function getHidden(): bool
    {
        return $this->hidden;
    }

    /**
     * Set hidden
     *
     * @param bool $hidden
     */
    public function setHidden(bool $hidden): void
    {
        $this->hidden = $hidden;
    }

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

    /**
     * Get text
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Set text
     *
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }
}
