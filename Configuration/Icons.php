<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


use TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider;
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

defined('TYPO3') or die();

// Extension-provided icons
return [
    'tx-chfbase' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_base/Resources/Public/Icons/Extension.svg',
    ],
    'tx-chfbase-table-agent' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_base/Resources/Public/Icons/TableAgent.svg',
    ],
    'tx-chfbase-table-extent' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_base/Resources/Public/Icons/TableExtent.svg',
    ],
    'tx-chfbase-table-footnote' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_base/Resources/Public/Icons/TableFootnote.svg',
    ],
    'tx-chfbase-table-keyword' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_base/Resources/Public/Icons/TableKeyword.svg',
    ],
    'tx-chfbase-table-location' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_base/Resources/Public/Icons/TableLocation.svg',
    ],
    'tx-chfbase-table-period' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_base/Resources/Public/Icons/TablePeriod.svg',
    ],
    'tx-chfbase-table-relation' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_base/Resources/Public/Icons/TableRelation.svg',
    ],
    'tx-chfbase-table-resource' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_base/Resources/Public/Icons/TableResource.svg',
    ],
    'tx-chfbase-table-same-as' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_base/Resources/Public/Icons/TableSameAs.svg',
    ],
    'tx-chfbase-table-tag' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_base/Resources/Public/Icons/TableTag.svg',
    ],
    'tx-chfbase-plugin-rest' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_base/Resources/Public/Icons/PluginRest.svg',
    ],
    'tx-chfbase-plugin-contributors' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_base/Resources/Public/Icons/PluginContributors.svg',
    ],
    'tx-chfbase-plugin-agents' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_base/Resources/Public/Icons/PluginAgents.svg',
    ],
    'tx-chfbase-plugin-timeline' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_base/Resources/Public/Icons/PluginTimeline.svg',
    ],
    'tx-chfbase-plugin-places' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_base/Resources/Public/Icons/PluginPlaces.svg',
    ],
    'tx-chfbase-plugin-structure' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_base/Resources/Public/Icons/PluginStructure.svg',
    ],
    'tx-chfbase-plugin-connections' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_base/Resources/Public/Icons/PluginConnections.svg',
    ],
];
