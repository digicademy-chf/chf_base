<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFBase\UserFunctions\FormEngine;

use TYPO3\CMS\Backend\Form\FormDataProvider\TcaSlug;

defined('TYPO3') or die();

/**
 * User function to add slug prefixes
 *
 * @internal
 */
final class SlugPrefix
{
    /**
     * Add slug prefix
     * 
     * @param array $parameters
     * @param TcaSlug $reference
     * @return string
     */
    public function getPrefix(array $parameters, TcaSlug $reference): string
    {
        return '';
    }
}