<?php

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


/**
 * BibliographicResource and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.bibliographicResource',
        'label'                    => 'title',
        'label_alt'                => 'uri',
        'descriptionColumn'        => 'description',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'title ASC,uri ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_bib/Resources/Public/Icons/BibliographicResource.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'title,syncId,syncState,description,uri',
        'enablecolumns'            => [
            'disabled' => 'hidden',
            'fe_group' => 'fe_group',
        ],
    ],
    'columns' => [
        'hidden' => [
            'exclude' => true,
            'label'   => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.enabled',
            'config'  => [
                'type'       => 'check',
                'renderType' => 'checkboxToggle',
                'items'      => [
                    [
                        'label' => '',
                        'invertStateDisplay' => true,
                    ]
                ],
            ]
        ],
        'fe_group' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.fe_group',
            'config' => [
                'type'       => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'size'       => 5,
                'maxitems'   => 20,
                'items'      => [
                    [
                        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hide_at_login',
                        'value' => -1,
                    ],
                    [
                        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.any_login',
                        'value' => -2,
                    ],
                    [
                        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.usergroups',
                        'value' => '--div--',
                    ],
                ],
                'exclusiveKeys' => '-1,-2',
                'foreign_table' => 'fe_groups',
            ],
        ],
        'sys_language_uid' => [
            'exclude' => true,
            'label'   => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config'  => [
                'type' => 'language',
            ],
        ],
        'l18n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label'       => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'items'      => [
                    [
                        'label' => '',
                        'value' => 0,
                    ],
                ],
                'foreign_table'       => 'tx_chfbib_domain_model_bibliographic_resource',
                'foreign_table_where' => 'AND {#tx_chfbib_domain_model_bibliographic_resource}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbib_domain_model_bibliographic_resource}.{#sys_language_uid} IN (-1,0)',
                'default'             => 0,
            ],
        ],
        'l10n_source' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'l18n_diffsource' => [
            'config' => [
                'type'    => 'passthrough',
                'default' => '',
            ],
        ],
        'title' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.bibliographicResource.title',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.bibliographicResource.title.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'language' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.bibliographicResource.language',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.bibliographicResource.language.description',
            'config'      => [
                'type'     => 'language',
                'required' => true,
            ],
        ],
        'syncId' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.bibliographicResource.syncId',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.bibliographicResource.syncId.description',
            'config' => [
                'type'           => 'link',
                'allowedTypes'   => ['url'],
                'allowedOptions' => [],
                'mode'           => 'prepend',
                'valuePicker'    => [
                   'items' => [
                      ['HTTPS', 'https://'],
                      ['HTTP', 'http://'],
                   ],
                ],
            ],
        ],
        'syncState' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.bibliographicResource.syncState',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.bibliographicResource.syncState.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'description' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.bibliographicResource.description',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.bibliographicResource.description.description',
            'config'      => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 5,
                'max'  => 2000,
                'eval' => 'trim',
            ],
        ],
        'uri' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.bibliographicResource.uri',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.bibliographicResource.uri.description',
            'config' => [
                'type'           => 'link',
                'allowedTypes'   => ['page', 'url', 'record'],
                'allowedOptions' => [],
                'mode'           => 'prepend',
                'valuePicker'    => [
                   'items' => [
                      ['HTTPS', 'https://'],
                      ['HTTP', 'http://'],
                   ],
                ],
            ],
        ],
        'sameAs' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.bibliographicResource.sameAs',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.bibliographicResource.sameAs.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chfbib_domain_model_same_as',
                'foreign_field'       => 'parent_id',
                'foreign_table_field' => 'parent_table',
                'appearance'          => [
                    'collapseAll'                     => true,
                    'expandSingle'                    => true,
                    'newRecordLinkAddTitle'           => true,
                    'levelLinksPosition'              => 'top',
                    'useSortable'                     => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink'         => true,
                    'showSynchronizationLink'         => true,
                ],
            ],
        ],
        'entry' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.bibliographicResource.entry',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.bibliographicResource.entry.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chfbib_domain_model_entry',
                'foreign_field'       => 'parent_id',
                'foreign_table_field' => 'parent_table',
                'foreign_sortby'      => 'sorting',
                'appearance'          => [
                    'collapseAll'                     => true,
                    'expandSingle'                    => true,
                    'newRecordLinkAddTitle'           => true,
                    'levelLinksPosition'              => 'top',
                    'useSortable'                     => false,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink'         => true,
                    'showSynchronizationLink'         => true,
                ],
            ],
        ],
        'contributor' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.bibliographicResource.contributor',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.bibliographicResource.contributor.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chfbib_domain_model_contributor',
                'foreign_field'       => 'parent_id',
                'foreign_table_field' => 'parent_table',
                'foreign_sortby'      => 'sorting',
                'appearance'          => [
                    'collapseAll'                     => true,
                    'expandSingle'                    => true,
                    'newRecordLinkAddTitle'           => true,
                    'levelLinksPosition'              => 'top',
                    'useSortable'                     => false,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink'         => true,
                    'showSynchronizationLink'         => true,
                ],
            ],
        ],
        'tag' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.bibliographicResource.tag',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.bibliographicResource.tag.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chfbib_domain_model_tag',
                'foreign_field'       => 'parent_id',
                'foreign_table_field' => 'parent_table',
                'foreign_sortby'      => 'sorting',
                'appearance'          => [
                    'collapseAll'                     => true,
                    'expandSingle'                    => true,
                    'newRecordLinkAddTitle'           => true,
                    'levelLinksPosition'              => 'top',
                    'useSortable'                     => false,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink'         => true,
                    'showSynchronizationLink'         => true,
                ],
            ],
        ],
    ],
    'palettes' => [
        'titleLanguage' => [
            'showitem' => 'title,language,',
        ],
        'syncIdSyncState' => [
            'showitem' => 'syncId,syncState,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'hidden,titleLanguage,syncIdSyncState,description,uri,sameAs,
            --div--;LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.bibliographicResource.content,entry,contributor,tag,',
        ],
    ],
];

?>
