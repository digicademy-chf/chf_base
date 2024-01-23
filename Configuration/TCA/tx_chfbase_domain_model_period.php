<?php

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


/**
 * Period and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period',
        'label'                    => 'text',
        'label_alt'                => 'alternativeText,type',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'isHighlight ASC,when ASC,from ASC,to ASC,notBefore ASC,notAfter ASC,text ASC,alternativeText ASC,type ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_base/Resources/Public/Icons/Period.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'uuid,type,text,alternativeText,from,to,when,notBefore,notAfter,publicationDate,revisionNumber,revisionDate,editorialNote,importOrigin,import',
        'enablecolumns'            => [
            'disabled' => 'hidden',
            'fe_group' => 'fe_group',
        ],
    ],
    'columns' => [
        'fe_group' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.fe_group',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'size' => 5,
                'maxitems' => 20,
                'items' => [
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
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l18n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => '',
                        'value' => 0,
                    ],
                ],
                'foreign_table' => 'tx_chfbase_domain_model_period',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_period}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_period}.{#sys_language_uid} IN (-1,0)',
                'default' => 0,
            ],
        ],
        'l10n_source' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'l18n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
                'default' => '',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.enabled',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.hidden.description',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => '',
                        'invertStateDisplay' => true,
                    ]
                ],
            ]
        ],
        'parentTable' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'parent' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'parentResource' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.parentResource',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.parentResource.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingleBox',
                'foreign_table' => 'tx_chfbase_domain_model_resource',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_resource}.{#pid}=###CURRENT_PID###',
                'sortItems' => [
                    'label' => 'asc',
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'parentPeriod' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.parentPeriod',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.parentPeriod.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectTree',
                'foreign_table' => 'tx_chfbase_domain_model_period',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_period}.{#pid}=###CURRENT_PID###',
                'treeConfig' => [
                    'parentField' => 'parentPeriod',
                ],
                'maxitems' => 1,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'uuid' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.uuid',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.uuid.description',
            'config' => [
                'type' => 'uuid',
                'size' => 40,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
                'required' => true,
            ],
        ],
        'type' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.type',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.type.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.type.labelTag',
                        'value' => 'date',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.type.labelTypeTag',
                        'value' => 'event',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.type.licenceTag',
                        'value' => 'period',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.type.licenceTag',
                        'value' => 'century',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.type.licenceTag',
                        'value' => 'era',
                    ],
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
                'required' => true,
            ],
        ],
        'text' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.text',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.text.description',
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
        'alternativeText' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.alternativeText',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.alternativeText.description',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'from' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.from',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.from.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'eval' => 'int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'to' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.to',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.to.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'eval' => 'int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'when' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.when',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.when.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'eval' => 'int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'notBefore' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.notBefore',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.notBefore.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'eval' => 'int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'notAfter' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.notAfter',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.notAfter.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'eval' => 'int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'calendar' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.calendar',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.calendar.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.calendar.gregorian',
                        'value' => 'gregorian',
                    ],
                ],
                'sortItems' => [
                    'label' => 'asc',
                ],
                'default' => 'gregorian',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
                'required' => true,
            ],
        ],
        'isHighlight' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.isHighlight',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.isHighlight.description',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => ''
                    ]
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ]
        ],
        'label' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.label',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.label.description',
            'config'      => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfbase_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_tag}.{#type}=\'label\'',
                'MM' => 'tx_chfbase_domain_model_period_tag_label_mm',
                'size' => 5,
                'autoSizeMax' => 10,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => false,
                    ],
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'sameAs' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.sameAs',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.sameAs.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_same_as',
                'foreign_field' => 'parent',
                'foreign_table_field' => 'parent_table',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'top',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
        'authorshipRelation' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.authorshipRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.authorshipRelation.description',
            'config'      => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_relation}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_relation}.{#type}=\'authorshipRelation\'',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_opposite_field' => 'record',
                'size' => 5,
                'autoSizeMax' => 10,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => false,
                    ],
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'licenceRelation' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.licenceRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.licenceRelation.description',
            'config'      => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_relation}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_relation}.{#type}=\'licenceRelation\'',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_opposite_field' => 'record',
                'size' => 5,
                'autoSizeMax' => 10,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => false,
                    ],
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'publicationDate' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.publicationDate',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.publicationDate.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'eval' => 'int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'revisionNumber' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionNumber',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionNumber.description',
            'config' => [
                'type' => 'number',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'revisionDate' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionDate',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionDate.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'eval' => 'int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'editorialNote' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.editorialNote',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.editorialNote.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 5,
                'max' => 2000,
                'eval' => 'trim',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'event' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.event',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.period.event.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_period',
                'foreign_field' => 'parent',
                'foreign_table_field' => 'parent_table',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
                'appearance'=> [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'top',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
        'agentRelation' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.agentRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.agentRelation.description',
            'config'      => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_relation}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_relation}.{#type}=\'agentRelation\'',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_opposite_field' => 'record',
                'size' => 5,
                'autoSizeMax' => 10,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => false,
                    ],
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'locationRelation' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.locationRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.locationRelation.description',
            'config'      => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_relation}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_relation}.{#type}=\'locationRelation\'',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_opposite_field' => 'record',
                'size' => 5,
                'autoSizeMax' => 10,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => false,
                    ],
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'contentElement' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.contentElement',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.contentElement.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tt_content',
                'foreign_field' => 'parent',
                'foreign_table_field' => 'parent_table',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'top',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
        'footnote' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.footnote',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.footnote.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_footnote',
                'foreign_field' => 'parent',
                'foreign_table_field' => 'parent_table',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'top',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
        'media' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.media',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.media.description',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-media-types',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'file' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.file',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.file.description',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-text-types',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'linkRelation' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.linkRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.linkRelation.description',
            'config'      => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_relation}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_relation}.{#type}=\'linkRelation\'',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_opposite_field' => 'record',
                'size' => 5,
                'autoSizeMax' => 10,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => false,
                    ],
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'importOrigin' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.importOrigin',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.importOrigin.description',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'import' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'max' => 100000,
                'eval' => 'trim',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
    ],
    'palettes' => [
        'hiddenParentResource' => [
            'showitem' => 'hidden,parentResource,',
        ],
        'uuidType' => [
            'showitem' => 'uuid,type,',
        ],
        'textAlternativeText' => [
            'showitem' => 'text,alternativeText,',
        ],
        'fromToWhen' => [
            'showitem' => 'from,to,when,',
        ],
        'notBeforeNotAfter' => [
            'showitem' => 'notBefore,notAfter,',
        ],
        'calendarIsHighlight' => [
            'showitem' => 'calendar,isHighlight,',
        ],
        'publicationDateRevisionNumberRevisionDate' => [
            'showitem' => 'publicationDate,revisionNumber,revisionDate,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'hiddenParentResource,parentPeriod,uuidType,textAlternativeText,fromToWhen,notBeforeNotAfter,calendarIsHighlight,label,sameAs,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.editorial,authorshipRelation,licenceRelation,publicationDateRevisionNumberRevisionDate,editorialNote,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.content,event,agentRelation,locationRelation,contentElement,footnote,media,file,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.relations,linkRelation,volumeRelation,sourceRelation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import,importOrigin,import,',
        ],
    ],
];

?>
