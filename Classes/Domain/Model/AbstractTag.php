<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use Digicademy\CHFBase\Domain\Model\Traits\HiddenTrait;
use Digicademy\CHFBase\Domain\Model\Traits\IriTrait;
use Digicademy\CHFBase\Domain\Model\Traits\ParentResourceTrait;
use Digicademy\CHFBase\Domain\Model\Traits\SameAsTrait;
use Digicademy\CHFBase\Domain\Model\Traits\UuidTrait;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for AbstractTag
 */
class AbstractTag extends AbstractEntity
{
    use HiddenTrait;
    use IriTrait;
    use ParentResourceTrait;
    use SameAsTrait;
    use UuidTrait;

    /**
     * Type of tag
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
     * Full name of the tag
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
     * Abbreviation of the tag
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $code = '';

    /**
     * Brief information about the tag
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 2000,
        ],
    ])]
    protected string $description = '';

    /**
     * Database records connected to this tag
     * 
     * @var ObjectStorage<mixed>
     */
    #[Lazy()]
    protected ObjectStorage $items;

    /**
     * Construct object
     *
     * @param string $text
     * @return AbstractTag
     */
    public function __construct(string $text)
    {
        $this->initializeObject();

        $this->setType('0');
        $this->setText($text);
        $this->setIri('t');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->items = new ObjectStorage();
        $this->parentResource = new ObjectStorage();
        $this->sameAs = new ObjectStorage();
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
     * Get code
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set code
     *
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Get items
     *
     * @return ObjectStorage<mixed>
     */
    public function getItems(): ObjectStorage
    {
        return $this->items;
    }

    /**
     * Set items
     *
     * @param ObjectStorage<mixed> $items
     */
    public function setItems(ObjectStorage $items): void
    {
        $this->items = $items;
    }

    /**
     * Add items
     *
     * @param mixed $items
     */
    public function addItems(mixed $items): void
    {
        $this->items->attach($items);
    }

    /**
     * Remove items
     *
     * @param mixed $items
     */
    public function removeItems(mixed $items): void
    {
        $this->items->detach($items);
    }

    /**
     * Remove all items
     */
    public function removeAllItems(): void
    {
        $items = clone $this->items;
        $this->items->removeAll($items);
    }
}
