<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use Digicademy\CHFBib\Domain\Model\BibliographicEntry;
use Digicademy\CHFBib\Domain\Model\BibliographicResource;
use Digicademy\CHFGloss\Domain\Model\GlossaryResource;
use Digicademy\CHFLex\Domain\Model\DictionaryEntry;
use Digicademy\CHFLex\Domain\Model\EncyclopediaEntry;
use Digicademy\CHFLex\Domain\Model\LexicographicResource;
use Digicademy\CHFMap\Domain\Model\Feature;
use Digicademy\CHFMap\Domain\Model\MapResource;
use Digicademy\CHFMedia\Domain\Model\FileGroup;
use Digicademy\CHFObject\Domain\Model\ObjectGroup;
use Digicademy\CHFObject\Domain\Model\ObjectResource;
use Digicademy\CHFObject\Domain\Model\SingleObject;
use Digicademy\CHFPub\Domain\Model\Essay;
use Digicademy\CHFPub\Domain\Model\PublicationResource;
use Digicademy\CHFPub\Domain\Model\Volume;

defined('TYPO3') or die();

/**
 * Model for LinkRelation
 */
class LinkRelation extends AbstractRelation
{
    /**
     * Record to connect a relation to
     * 
     * @var Agent|Location|Period|BibliographicEntry|DictionaryEntry|EncyclopediaEntry|Feature|FileGroup|SingleObject|ObjectGroup|Essay|Volume|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected Agent|Location|Period|BibliographicEntry|DictionaryEntry|EncyclopediaEntry|Feature|FileGroup|SingleObject|ObjectGroup|Essay|Volume|null $record = null;

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
     * @param Agent|Location|Period|BibliographicEntry|DictionaryEntry|EncyclopediaEntry|Feature|FileGroup|SingleObject|ObjectGroup|Essay|Volume $record
     * @param string $url
     * @param BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource
     * @param string $iri
     * @param string $uuid
     * @return LinkRelation
     */
    public function __construct(Agent|Location|Period|BibliographicEntry|DictionaryEntry|EncyclopediaEntry|Feature|FileGroup|SingleObject|ObjectGroup|Essay|Volume $record, string $url, BibliographicResource|GlossaryResource|LexicographicResource|MapResource|ObjectResource|PublicationResource $parentResource, string $iri, string $uuid)
    {
        parent::__construct($parentResource, $iri, $uuid);

        $this->setType('linkRelation');
        $this->setRecord($record);
        $this->setUrl($url);
    }

    /**
     * Get record
     * 
     * @return Agent|Location|Period|BibliographicEntry|DictionaryEntry|EncyclopediaEntry|Feature|FileGroup|SingleObject|ObjectGroup|Essay|Volume
     */
    public function getRecord(): Agent|Location|Period|BibliographicEntry|DictionaryEntry|EncyclopediaEntry|Feature|FileGroup|SingleObject|ObjectGroup|Essay|Volume
    {
        if ($this->record instanceof LazyLoadingProxy) {
            $this->record->_loadRealInstance();
        }
        return $this->record;
    }

    /**
     * Set record
     * 
     * @param Agent|Location|Period|BibliographicEntry|DictionaryEntry|EncyclopediaEntry|Feature|FileGroup|SingleObject|ObjectGroup|Essay|Volume
     */
    public function setRecord(Agent|Location|Period|BibliographicEntry|DictionaryEntry|EncyclopediaEntry|Feature|FileGroup|SingleObject|ObjectGroup|Essay|Volume $record): void
    {
        $this->record = $record;
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
