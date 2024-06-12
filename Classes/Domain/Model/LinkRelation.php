<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for LinkRelation
 */
class LinkRelation extends AbstractRelation
{
    /**
     * Record to connect a relation to
     * 
     * @var ?ObjectStorage<object>
     */
    #[Lazy()]
    protected ?ObjectStorage $record;

    /**
     * URL that the link should point to
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'Url',
    ])]
    protected string $url = '';

    /**
     * Text to highlight as a link
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $linkText = '';

    /**
     * Date of the last successful URL retrieval
     * 
     * @var ?\DateTime
     */
    protected ?\DateTime $lastChecked = null;

    /**
     * Construct object
     *
     * @param object $parentResource
     * @param string $uuid
     * @param object $record
     * @param string $url
     * @return LinkRelation
     */
    public function __construct(object $parentResource, string $uuid, object $record, string $url)
    {
        parent::__construct($parentResource, $uuid);
        $this->initializeObject();

        $this->setType('linkRelation');
        $this->addRecord($record);
        $this->setUrl($url);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->record ??= new ObjectStorage();
    }

    /**
     * Get record
     *
     * @return ObjectStorage<object>
     */
    public function getRecord(): ?ObjectStorage
    {
        return $this->record;
    }

    /**
     * Set record
     *
     * @param ObjectStorage<object> $record
     */
    public function setRecord(ObjectStorage $record): void
    {
        $this->record = $record;
    }

    /**
     * Add record
     *
     * @param object $record
     */
    public function addRecord(object $record): void
    {
        $this->record?->attach($record);
    }

    /**
     * Remove record
     *
     * @param object $record
     */
    public function removeRecord(object $record): void
    {
        $this->record?->detach($record);
    }

    /**
     * Remove all records
     */
    public function removeAllRecord(): void
    {
        $record = clone $this->record;
        $this->record->removeAll($record);
    }

    /**
     * Get URL
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Set URL
     *
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * Get link text
     *
     * @return string
     */
    public function getLinkText(): string
    {
        return $this->linkText;
    }

    /**
     * Set link text
     *
     * @param string $linkText
     */
    public function setLinkText(string $linkText): void
    {
        $this->linkText = $linkText;
    }

    /**
     * Get last checked
     *
     * @return ?\DateTime
     */
    public function getLastChecked(): ?\DateTime
    {
        return $this->lastChecked;
    }

    /**
     * Set last checked
     *
     * @param \DateTime $lastChecked
     */
    public function setLastChecked(\DateTime $lastChecked): void
    {
        $this->lastChecked = $lastChecked;
    }
}
