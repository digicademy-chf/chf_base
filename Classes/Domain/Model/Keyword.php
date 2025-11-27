<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use Digicademy\CHFBase\Domain\Model\Traits\HiddenTrait;
use Digicademy\CHFBase\Domain\Model\Traits\ParentResourceTrait;
use TYPO3\CMS\Extbase\Attribute\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for Keyword
 */
class Keyword extends AbstractEntity
{
    use HiddenTrait;
    use ParentResourceTrait;

    /**
     * Title of this keyword
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
     * @return Keyword
     */
    public function __construct(string $text)
    {
        $this->initializeObject();

        $this->setText($text);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->parentResource = new ObjectStorage();
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
