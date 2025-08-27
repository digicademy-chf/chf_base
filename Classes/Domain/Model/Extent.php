<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use Digicademy\CHFBase\Domain\Model\Traits\HiddenTrait;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

defined('TYPO3') or die();

/**
 * Model for Extent
 */
class Extent extends AbstractEntity
{
    use HiddenTrait;

    /**
     * Specific identifier/dimension
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $text = '';

    /**
     * Type of identifier/dimension
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength', # Validates for string length instead of string values to allow other models to add further types
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $type = '';

    /**
     * Construct object
     *
     * @param string $text
     * @param string $type
     * @return Extent
     */
    public function __construct(string $text, string $type)
    {
        $this->setText($text);
        $this->setType($type);
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

    /**
     * Get type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }
}
