<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
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

// Add plugin 'Rest'
ExtensionUtility::registerPlugin(
    'CHFBase',
    'Rest',
    'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:plugin.rest',
    'tx-chfbase-plugin-rest',
    'heritage',
    'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:plugin.rest.description',
    'FILE:EXT:chf_base/Configuration/FlexForms/PluginData.xml',
);

// Add plugin 'Contributors'
ExtensionUtility::registerPlugin(
    'CHFBase',
    'Contributors',
    'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:plugin.contributors',
    'tx-chfbase-plugin-contributors',
    'heritage',
    'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:plugin.contributors.description',
    'FILE:EXT:chf_base/Configuration/FlexForms/PluginData.xml',
);

// Add plugin 'Agents'
ExtensionUtility::registerPlugin(
    'CHFBase',
    'Agents',
    'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:plugin.agents',
    'tx-chfbase-plugin-agents',
    'heritage',
    'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:plugin.agents.description',
    'FILE:EXT:chf_base/Configuration/FlexForms/PluginData.xml',
);

// Add plugin 'Timeline'
ExtensionUtility::registerPlugin(
    'CHFBase',
    'Timeline',
    'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:plugin.timeline',
    'tx-chfbase-plugin-timeline',
    'heritage',
    'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:plugin.timeline.description',
    'FILE:EXT:chf_base/Configuration/FlexForms/PluginData.xml',
);

// Add plugin 'Places'
ExtensionUtility::registerPlugin(
    'CHFBase',
    'Places',
    'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:plugin.places',
    'tx-chfbase-plugin-places',
    'heritage',
    'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:plugin.places.description',
    'FILE:EXT:chf_base/Configuration/FlexForms/PluginData.xml',
);

// Add plugin 'Structure'
ExtensionUtility::registerPlugin(
    'CHFBase',
    'Structure',
    'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:plugin.structure',
    'tx-chfbase-plugin-structure',
    'heritage',
    'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:plugin.structure.description',
    'FILE:EXT:chf_base/Configuration/FlexForms/PluginData.xml',
);

// Add plugin 'Connections'
ExtensionUtility::registerPlugin(
    'CHFBase',
    'Connections',
    'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:plugin.connections',
    'tx-chfbase-plugin-connections',
    'heritage',
    'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:plugin.connections.description',
    'FILE:EXT:chf_base/Configuration/FlexForms/PluginData.xml',
);

// Add data tab to plugin form
ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    '--div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:plugin.generic.data,pi_flexform',
    'chfbase_rest,chfbase_contributors,chfbase_agents,chfbase_timeline,chfbase_places,chfbase_structure,chfbase_connections',
    'after:subheader',
);
