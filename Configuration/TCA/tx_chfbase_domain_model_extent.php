<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * Extent and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.extent',
        'label'                    => 'text',
        'label_alt'                => 'type',
        'label_alt_force'          => true,
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'text ASC,type ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_base/Resources/Public/Icons/TableExtent.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'text,type',
        'enablecolumns'            => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
            'fe_group' => 'fe_group',
        ],
    ],
    'columns' => [
        'text' => [
            'exclude' => true,
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.extent.text',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.extent.text.description',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
                'required' => true,
            ],
        ],
        'type' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.extent.type',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.extent.type.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.extent.type.url',
                        'value' => 'url',
                        'group' => 'chfBase',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.extent.type.doi',
                        'value' => 'doi',
                        'group' => 'chfBase',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.extent.type.urn',
                        'value' => 'urn',
                        'group' => 'chfBase',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.extent.type.issn',
                        'value' => 'issn',
                        'group' => 'chfBase',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.extent.type.isbn',
                        'value' => 'isbn',
                        'group' => 'chfBase',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.extent.type.edition',
                        'value' => 'edition',
                        'group' => 'chfBase',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.extent.type.version',
                        'value' => 'version',
                        'group' => 'chfBase',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.extent.type.volume',
                        'value' => 'volume',
                        'group' => 'chfBase',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.extent.type.issue',
                        'value' => 'issue',
                        'group' => 'chfBase',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.extent.type.pageNumbers',
                        'value' => 'pageNumbers',
                        'group' => 'chfBase',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.extent.type.paragraphNumbers',
                        'value' => 'paragraphNumbers',
                        'group' => 'chfBase',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.extent.type.columnNumbers',
                        'value' => 'columnNumbers',
                        'group' => 'chfBase',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.extent.type.chapterNumbers',
                        'value' => 'chapterNumbers',
                        'group' => 'chfBase',
                    ],
                ],
                'itemGroups' => [
                    'chfBase' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.chfBase',
                ],
                'required' => true,
            ],
        ],
        'parent_table' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'parent' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
    'palettes' => [
        'textType' => [
            'showitem' => 'text,type,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => '--palette--;;textType,',
        ],
    ],
];
