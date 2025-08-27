<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

defined('TYPO3') or die();

/**
 * Model for GenericResource
 */
class GenericResource extends AbstractResource
{
    /**
     * Construct object
     *
     * @param string $langCode
     * @return GenericResource
     */
    public function __construct(string $langCode)
    {
        parent::__construct($langCode);
        
        $this->setType('genericResource');
    }
}
