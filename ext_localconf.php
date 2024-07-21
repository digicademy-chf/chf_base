<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


use Digicademy\CHFBase\Controller\AbstractResourceController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

// Customisations of the rich-text editor
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets'] += [
    'chf_base_simple' => 'EXT:chf_base/Configuration/RTE/CHFBaseSimple.yaml',
    'chf_base_regular' => 'EXT:chf_base/Configuration/RTE/CHFBaseRegular.yaml',
];

// Register 'BaseRest' content element
ExtensionUtility::configurePlugin(
    'CHFBase',
    'BaseRest',
    [
        AbstractResourceController::class => 'index',
        AbstractResourceController::class => 'show',
    ],
);
