<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

/**
 * ContentElement and its properties
 * 
 * Extension of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */

// Add CHF tab for plugins
$GLOBALS['TCA']['tt_content']['columns']['CType']['config']['itemGroups']['heritage']
    = 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:plugin.generic.heritage';

// Add plugin 'BaseRest'
ExtensionUtility::registerPlugin(
    'CHFBase',
    'BaseRest',
    'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:plugin.baseRest',
    'tx-chfbase-plugin-base-rest',
    'heritage',
    'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:plugin.baseRest.description',
);
