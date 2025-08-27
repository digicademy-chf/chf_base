<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model\Traits;

use Digicademy\CHFBase\Domain\Model\AbstractBase;
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
     * @var AbstractBase|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected AbstractBase|null $record = null;

    /**
     * Get record
     * 
     * @return AbstractBase
     */
    public function getRecord(): AbstractBase
    {
        if ($this->record instanceof LazyLoadingProxy) {
            $this->record->_loadRealInstance();
        }
        return $this->record;
    }

    /**
     * Set record
     * 
     * @param AbstractBase
     */
    public function setRecord(AbstractBase $record): void
    {
        $this->record = $record;
    }
}
