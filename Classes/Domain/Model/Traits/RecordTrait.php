<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model\Traits;

use Digicademy\CHFBase\Domain\Model\AbstractResource;
use Digicademy\CHFBase\Domain\Model\Agent;
use Digicademy\CHFBase\Domain\Model\Location;
use Digicademy\CHFBase\Domain\Model\Period;
use Digicademy\CHFBib\Domain\Model\BibliographicEntry;
use Digicademy\CHFGloss\Domain\Model\GlossaryEntry;
use Digicademy\CHFLex\Domain\Model\DictionaryEntry;
use Digicademy\CHFLex\Domain\Model\EncyclopediaEntry;
use Digicademy\CHFLex\Domain\Model\Example;
use Digicademy\CHFLex\Domain\Model\Frequency;
use Digicademy\CHFMap\Domain\Model\Feature;
use Digicademy\CHFMedia\Domain\Model\FileGroup;
use Digicademy\CHFObject\Domain\Model\SingleObject;
use Digicademy\CHFObject\Domain\Model\ObjectGroup;
use Digicademy\CHFPub\Domain\Model\Essay;
use Digicademy\CHFPub\Domain\Model\Volume;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;

defined('TYPO3') or die();

/**
 * Trait for models to include a record property
 */
trait RecordTrait
{
    /**
     * Record to connect a relation to
     * 
     * @var AbstractResource|Agent|Location|Period|BibliographicEntry|GlossaryEntry|DictionaryEntry|EncyclopediaEntry|Example|Frequency|Feature|FileGroup|SingleObject|ObjectGroup|Essay|Volume|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected AbstractResource|Agent|Location|Period|BibliographicEntry|GlossaryEntry|DictionaryEntry|EncyclopediaEntry|Example|Frequency|Feature|FileGroup|SingleObject|ObjectGroup|Essay|Volume|LazyLoadingProxy|null $record = null;

    /**
     * Get record
     * 
     * @return AbstractResource|Agent|Location|Period|BibliographicEntry|GlossaryEntry|DictionaryEntry|EncyclopediaEntry|Example|Frequency|Feature|FileGroup|SingleObject|ObjectGroup|Essay|Volume
     */
    public function getRecord(): AbstractResource|Agent|Location|Period|BibliographicEntry|GlossaryEntry|DictionaryEntry|EncyclopediaEntry|Example|Frequency|Feature|FileGroup|SingleObject|ObjectGroup|Essay|Volume
    {
        if ($this->record instanceof LazyLoadingProxy) {
            $this->record->_loadRealInstance();
        }
        return $this->record;
    }

    /**
     * Set record
     * 
     * @param AbstractResource|Agent|Location|Period|BibliographicEntry|GlossaryEntry|DictionaryEntry|EncyclopediaEntry|Example|Frequency|Feature|FileGroup|SingleObject|ObjectGroup|Essay|Volume
     */
    public function setRecord(AbstractResource|Agent|Location|Period|BibliographicEntry|GlossaryEntry|DictionaryEntry|EncyclopediaEntry|Example|Frequency|Feature|FileGroup|SingleObject|ObjectGroup|Essay|Volume $record): void
    {
        $this->record = $record;
    }
}
