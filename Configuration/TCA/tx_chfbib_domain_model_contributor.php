<?php

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


/**
 * Contributor and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.contributor',
        'label'                    => 'surname',
        'label_alt'                => 'forename,corporateName',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'surname ASC,forename ASC,corporateName ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_bib/Resources/Public/Icons/Contributor.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'uuid,surname,forename,corporateName',
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
                'foreign_table'       => 'tx_chfbib_domain_model_contributor',
                'foreign_table_where' => 'AND {#tx_chfbib_domain_model_contributor}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbib_domain_model_contributor}.{#sys_language_uid} IN (-1,0)',
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
        'parent_id' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.contributor.parent_id',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.contributor.parent_id.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_chfbib_domain_model_bibliographic_resource',
                'foreign_table_where' => 'AND {#tx_chfbib_domain_model_bibliographic_resource}.{#pid}=###CURRENT_PID###',
                'maxitems'            => 1,
                'required'            => true,
            ],
        ],
        'uuid' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.contributor.uuid',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.contributor.uuid.description',
            'config'      => [
                'type'     => 'uuid',
                'size'     => 40,
                'required' => true,
            ],
        ],
        'surname' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.contributor.surname',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.contributor.surname.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'forename' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.contributor.forename',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.contributor.forename.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'corporateName' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.contributor.corporateName',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.contributor.corporateName.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'label' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.contributor.label',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.contributor.label.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbib_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chfbib_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbib_domain_model_tag}.{#type}=\'label\'',
                'MM'                  => 'tx_chfbib_domain_model_contributor_tag_label_mm',
                'size'                => 5,
                'autoSizeMax'         => 10,
                'fieldControl'        => [
                    'editPopup'  => [
                        'disabled' => false,
                    ],
                    'addRecord'  => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => false,
                    ],
                ],
            ],
        ],
        'sameAs' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.contributor.sameAs',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.contributor.sameAs.description',
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
        'asAuthor' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.contributor.asAuthor',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.contributor.asAuthor.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbib_domain_model_entry',
                'foreign_table_where' => 'AND {#tx_chfbib_domain_model_entry}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbib_domain_model_entry_contributor_author_mm',
                'MM_opposite_field'   => 'author',
                'size'                => 5,
                'autoSizeMax'         => 10,
                'fieldControl'        => [
                    'editPopup'  => [
                        'disabled' => false,
                    ],
                    'addRecord'  => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => false,
                    ],
                ],
            ],
        ],
        'asEditor' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.contributor.asEditor',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.contributor.asEditor.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbib_domain_model_entry',
                'foreign_table_where' => 'AND {#tx_chfbib_domain_model_entry}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbib_domain_model_entry_contributor_editor_mm',
                'MM_opposite_field'   => 'editor',
                'size'                => 5,
                'autoSizeMax'         => 10,
                'fieldControl'        => [
                    'editPopup'  => [
                        'disabled' => false,
                    ],
                    'addRecord'  => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => false,
                    ],
                ],
            ],
        ],
        'asTranslator' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.contributor.asTranslator',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.contributor.asTranslator.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbib_domain_model_entry',
                'foreign_table_where' => 'AND {#tx_chfbib_domain_model_entry}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbib_domain_model_entry_contributor_translator_mm',
                'MM_opposite_field'   => 'translator',
                'size'                => 5,
                'autoSizeMax'         => 10,
                'fieldControl'        => [
                    'editPopup'  => [
                        'disabled' => false,
                    ],
                    'addRecord'  => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => false,
                    ],
                ],
            ],
        ],
        'asGenericContributor' => [
            'label'       => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.contributor.asGenericContributor',
            'description' => 'LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.contributor.asGenericContributor.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbib_domain_model_entry',
                'foreign_table_where' => 'AND {#tx_chfbib_domain_model_entry}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbib_domain_model_entry_contributor_generic_mm',
                'MM_opposite_field'   => 'genericContributor',
                'size'                => 5,
                'autoSizeMax'         => 10,
                'fieldControl'        => [
                    'editPopup'  => [
                        'disabled' => false,
                    ],
                    'addRecord'  => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => false,
                    ],
                ],
            ],
        ],
    ],
    'palettes' => [
        'hiddenParentId' => [
            'showitem' => 'hidden,parent_id,',
        ],
        'surnameForename' => [
            'showitem' => 'surname,forename,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'hiddenParentId,uuid,surnameForename,corporateName,label,sameAs,
            --div--;LLL:EXT:chf_bib/Resources/Private/Language/locallang.xlf:database.contributor.contributions,asAuthor,asEditor,asTranslator,asGenericContributor,',
        ],
    ],
];

?>
