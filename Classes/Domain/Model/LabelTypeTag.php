<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\Domain\Model;

defined('TYPO3') or die();

/**
 * Model for LabelTypeTag
 */
class LabelTypeTag extends AbstractTag
{
    /**
     * Construct object
     *
     * @param string $text
     * @return LabelTypeTag
     */
    public function __construct(string $text)
    {
        parent::__construct($text);

        $this->setType('labelTypeTag');
    }
}
