<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use Digicademy\CHFBase\Domain\Model\Traits\HiddenTrait;
use Digicademy\CHFBase\Domain\Model\Traits\UuidTrait;
use TYPO3\CMS\Extbase\Attribute\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

defined('TYPO3') or die();

/**
 * Model for Footnote
 */
class Footnote extends AbstractEntity
{
    use HiddenTrait;
    use UuidTrait;

    /**
     * Footnote content
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
     * @param string $text
     * @return Footnote
     */
    public function __construct(string $text)
    {
        $this->setText($text);
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
