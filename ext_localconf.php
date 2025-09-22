<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


use Digicademy\CHFBase\Controller\AgentsController;
use Digicademy\CHFBase\Controller\ConnectionsController;
use Digicademy\CHFBase\Controller\ContributorsController;
use Digicademy\CHFBase\Controller\PlacesController;
use Digicademy\CHFBase\Controller\RestController;
use Digicademy\CHFBase\Controller\StructureController;
use Digicademy\CHFBase\Controller\TimelineController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

// Rich-text editor customisations
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets'] += [
    'chf_base_simple' => 'EXT:chf_base/Configuration/RTE/CHFBaseSimple.yaml',
    'chf_base_regular' => 'EXT:chf_base/Configuration/RTE/CHFBaseRegular.yaml',
];

// Activate optional features
$GLOBALS['TYPO3_CONF_VARS']['SYS']['features']['extbase.consistentDateTimeHandling'] = true;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['features']['frontend.cache.autoTagging'] = true;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['features']['security.backend.htmlSanitizeRte'] = true;

// Register 'Rest' content element
ExtensionUtility::configurePlugin(
    'CHFBase',
    'Rest',
    [
        RestController::class => 'index',
    ],
    [], // None of the actions are non-cacheable
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

// Register 'Contributors' content element
ExtensionUtility::configurePlugin(
    'CHFBase',
    'Contributors',
    [
        ContributorsController::class => 'index, show',
    ],
    [], // None of the actions are non-cacheable
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

// Register 'Agents' content element
ExtensionUtility::configurePlugin(
    'CHFBase',
    'Agents',
    [
        AgentsController::class => 'index, show',
    ],
    [], // None of the actions are non-cacheable
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

// Register 'Timeline' content element
ExtensionUtility::configurePlugin(
    'CHFBase',
    'Timeline',
    [
        TimelineController::class => 'index, show',
    ],
    [], // None of the actions are non-cacheable
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

// Register 'Places' content element
ExtensionUtility::configurePlugin(
    'CHFBase',
    'Places',
    [
        PlacesController::class => 'index, show',
    ],
    [], // None of the actions are non-cacheable
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

// Register 'Structure' content element
ExtensionUtility::configurePlugin(
    'CHFBase',
    'Structure',
    [
        StructureController::class => 'index, show, showKeyword',
    ],
    [], // None of the actions are non-cacheable
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

// Register 'Connections' content element
ExtensionUtility::configurePlugin(
    'CHFBase',
    'Connections',
    [
        ConnectionsController::class => 'index',
    ],
    [], // None of the actions are non-cacheable
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);
