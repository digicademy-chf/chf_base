<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

use Digicademy\CHFBase\Domain\Model\Traits\RecordTrait;
use Digicademy\CHFBib\Domain\Model\BibliographicEntry;
use Digicademy\CHFGloss\Domain\Model\GlossaryEntry;
use Digicademy\CHFLex\Domain\Model\DictionaryEntry;
use Digicademy\CHFLex\Domain\Model\EncyclopediaEntry;
use Digicademy\CHFMap\Domain\Model\Feature;
use Digicademy\CHFMedia\Domain\Model\FileGroup;
use Digicademy\CHFObject\Domain\Model\SingleObject;
use Digicademy\CHFObject\Domain\Model\ObjectGroup;
use Digicademy\CHFPub\Domain\Model\Essay;
use Digicademy\CHFPub\Domain\Model\Volume;
use TYPO3\CMS\Extbase\Annotation\Validate;

defined('TYPO3') or die();

/**
 * Model for LinkRelation
 */
class LinkRelation extends AbstractRelation
{
    use RecordTrait;

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
     * @param Agent|Location|Period|BibliographicEntry|GlossaryEntry|DictionaryEntry|EncyclopediaEntry|Feature|FileGroup|SingleObject|ObjectGroup|Essay|Volume $record
     * @param string $url
     * @return LinkRelation
     */
    public function __construct(Agent|Location|Period|BibliographicEntry|GlossaryEntry|DictionaryEntry|EncyclopediaEntry|Feature|FileGroup|SingleObject|ObjectGroup|Essay|Volume $record, string $url)
    {
        parent::__construct();

        $this->setType('linkRelation');
        $this->setRecord($record);
        $this->setUrl($url);
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
