<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use Digicademy\CHFBase\Domain\Model\Traits\ImportStateTrait;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for AbstractResource
 */
class AbstractResource extends AbstractBase
{
    use ImportStateTrait;

    /**
     * Type of resource
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
     * Name of this resource
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $title = '';

    /**
     * Language of this resource
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength', # Generic validator because there is no canonical list of allowed options to check against
        'options'   => [
            'minimum' => 1,
        ],
    ])]
    protected string $langCode = '';

    /**
     * Brief statement about this resource
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
     * Database records connected to this resource
     * 
     * @var ?ObjectStorage<mixed>
     */
    #[Lazy()]
    protected ?ObjectStorage $items = null;

    /**
     * Construct object
     *
     * @param string $langCode
     * @return AbstractResource
     */
    public function __construct(string $langCode)
    {
        parent::__construct();
        $this->initializeObject();

        $this->setType('0');
        $this->setLangCode($langCode);
        $this->setIri('z');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->items ??= new ObjectStorage();
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
     * Get title
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setCode(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Get lang code
     *
     * @return string
     */
    public function getLangCode(): string
    {
        return $this->langCode;
    }

    /**
     * Set lang code
     *
     * @param string $langCode
     */
    public function setLangCode(string $langCode): void
    {
        $this->langCode = $langCode;
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
    public function getItems(): ?ObjectStorage
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
        $this->items?->attach($items);
    }

    /**
     * Remove items
     *
     * @param mixed $items
     */
    public function removeItems(mixed $items): void
    {
        $this->items?->detach($items);
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
