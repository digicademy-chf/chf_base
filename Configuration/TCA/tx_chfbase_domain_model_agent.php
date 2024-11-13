<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * Agent and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent',
        'label'                    => 'surname',
        'label_alt'                => 'forename,corporate_name,alternative_name',
        'label_alt_force'          => true,
        'descriptionColumn'        => 'editorial_note',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'is_highlight ASC,surname ASC,forename ASC,corporate_name ASC,alternative_name ASC,type ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_base/Resources/Public/Icons/TableAgent.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'type,forename,surname,corporate_name,alternative_name,honorific,occupation,gender,uuid,publication_date,revision_date,revision_number,editorial_note,import_origin,import',
        'enablecolumns'            => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
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
                'foreign_table_where' => 'ORDER BY fe_groups.title',
            ],
        ],
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l10n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => '',
                        'value' => 0,
                    ],
                ],
                'foreign_table' => 'tx_chfbase_domain_model_agent',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_agent}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_agent}.{#sys_language_uid} IN (-1,0)',
                'default' => 0,
            ],
        ],
        'l10n_source' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
                'default' => '',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
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
        'starttime' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.starttime.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'datetime',
                'eval' => 'int',
                'default' => 0,
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.endtime.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'datetime',
                'eval' => 'int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2106),
                ],
            ],
        ],
        'type' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.type',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.type.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.type.person',
                        'value' => 'person',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.type.organisation',
                        'value' => 'organisation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.type.otherEntity',
                        'value' => 'otherEntity',
                    ],
                ],
                'default' => 'person',
                'required' => true,
            ],
        ],
        'forename' => [
            'exclude' => true,
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.forename',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.forename.description',
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
        'surname' => [
            'exclude' => true,
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.surname',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.surname.description',
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
        'corporate_name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.corporateName',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.corporateName.description',
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
        'alternative_name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.alternativeName',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.alternativeName.description',
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
        'honorific' => [
            'exclude' => true,
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.honorific',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.honorific.description',
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
        'occupation' => [
            'exclude' => true,
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.occupation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.occupation.description',
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
        'gender' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.gender',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.gender.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingleBox',
                'items' => [
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.gender.female',
                        'value' => 'female',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.gender.male',
                        'value' => 'male',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.gender.nonBinary',
                        'value' => 'nonBinary',
                    ],
                ],
            ],
        ],
        'label' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.label',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.label.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectTree',
                'foreign_table' => 'tx_chfbase_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_tag}.{#pid}=###CURRENT_PID###'
                #'foreign_table_where' => 'AND {#tx_chfbase_domain_model_tag}.{#parent_resource}=###REC_FIELD_parent_resource###'
                    . ' AND {#tx_chfbase_domain_model_tag}.{#type}=\'labelTag\'',
                'MM' => 'tx_chfbase_domain_model_agent_tag_label_mm',
                'multiple' => 1,
                'treeConfig' => [
                    'parentField' => 'parent_label_tag',
                    'appearance' => [
                        'showHeader' => true,
                        'expandAll' => true,
                    ],
                ],
                'size' => 8,
            ],
        ],
        'agent' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.agent',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.agent.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_agent',
                'foreign_field' => 'parent_agent',
                'appearance'=> [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
        'event' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.event',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.event.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_period',
                'foreign_field' => 'parent',
                'foreign_table_field' => 'parent_table',
                'appearance'=> [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
        'agent_relation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.agentRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.agentRelation.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_match_fields' => [
                    'tablenames' => 'tx_chfbase_domain_model_agent',
                    'fieldname' => 'agent_relation',
                ],
                'MM_opposite_field' => 'record',
                'multiple' => 1,
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
                'overrideChildTca' => [
                    'columns' => [
                        'type' => [
                            'config' => [
                                'default' => 'agentRelation',
                                'readOnly' => true,
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'location_relation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.locationRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.locationRelation.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_match_fields' => [
                    'tablenames' => 'tx_chfbase_domain_model_agent',
                    'fieldname' => 'location_relation',
                ],
                'MM_opposite_field' => 'record',
                'multiple' => 1,
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
                'overrideChildTca' => [
                    'columns' => [
                        'type' => [
                            'config' => [
                                'default' => 'locationRelation',
                                'readOnly' => true,
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'content_element' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.contentElement',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.contentElement.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tt_content',
                'foreign_field' => 'parent',
                'foreign_table_field' => 'parent_table',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
        'footnote' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.footnote',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.footnote.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_footnote',
                'foreign_field' => 'parent',
                'foreign_table_field' => 'parent_table',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
        'media' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.media',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.media.description',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-media-types',
            ],
        ],
        'file' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.file',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.file.description',
            'config' => [
                'type' => 'file',
            ],
        ],
        'link_relation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.linkRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.linkRelation.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_match_fields' => [
                    'tablenames' => 'tx_chfbase_domain_model_agent',
                    'fieldname' => 'link_relation',
                ],
                'MM_opposite_field' => 'record',
                'multiple' => 1,
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
                'overrideChildTca' => [
                    'columns' => [
                        'type' => [
                            'config' => [
                                'default' => 'linkRelation',
                                'readOnly' => true,
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'is_teaser' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.isTeaser',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.isTeaser.description',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => '',
                    ]
                ],
            ]
        ],
        'is_highlight' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
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
            ]
        ],
        'is_contributor' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.isContributor',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.isContributor.description',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => ''
                    ]
                ],
            ]
        ],
        'parent_agent' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.parentAgent',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.parentAgent.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectTree',
                'foreign_table' => 'tx_chfbase_domain_model_agent',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_agent}.{#pid}=###CURRENT_PID###',
                #'foreign_table_where' => 'AND {#tx_chfbase_domain_model_agent}.{#parent_resource}=###REC_FIELD_parent_resource###',
                'treeConfig' => [
                    'parentField' => 'parent_agent',
                    'appearance' => [
                        'showHeader' => true,
                        'expandAll' => true,
                    ],
                ],
                'maxitems' => 1,
                'size' => 8,
            ],
        ],
        'parent_resource' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
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
                'required' => true,
            ],
        ],
        /*'iri' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.iri',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.iri.description',
            'config' => [
                'type' => 'slug',
                'size' => 50,
                'generatorOptions' => [
                    'fields' => [
                        'uid',
                    ],
                    'fieldSeparator' => '',
                    'prefixParentPageSlug' => false,
                    'replacements' => [
                        '/' => '',
                    ],
                ],
                'appearance' => [
                    'prefix' => 'Digicademy\CHFBase\UserFunctions\FormEngine\SlugPrefix->getPrefix',
                ],
                'fallbackCharacter' => '',
                'prependSlash' => false,
                'eval' => 'uniqueInSite',
                'default' => 'a',
                'required' => true,
            ],
        ],*/
        'uuid' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.uuid',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.uuid.description',
            'config' => [
                'type' => 'uuid',
                'size' => 40,
                'required' => true,
            ],
        ],
        'same_as' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.sameAs',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.sameAs.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_same_as',
                'foreign_field' => 'parent',
                'foreign_table_field' => 'parent_table',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
        'publication_date' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.publicationDate',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.publicationDate.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'default' => 0,
            ],
        ],
        'revision_date' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionDate',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionDate.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'default' => 0,
            ],
        ],
        'revision_number' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionNumber',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionNumber.description',
            'config' => [
                'type' => 'number',
                'size' => 13,
                'default' => 1,
                'range' => [
                    'lower' => 1,
                ],
                'required' => true,
            ],
        ],
        'editorial_note' => [
            'exclude' => true,
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
        'authorship_relation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.authorshipRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.authorshipRelation.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_match_fields' => [
                    'tablenames' => 'tx_chfbase_domain_model_agent',
                    'fieldname' => 'authorship_relation',
                ],
                'MM_opposite_field' => 'record',
                'multiple' => 1,
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
                'overrideChildTca' => [
                    'columns' => [
                        'type' => [
                            'config' => [
                                'default' => 'authorshipRelation',
                                'readOnly' => true,
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'licence_relation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.licenceRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.licenceRelation.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_match_fields' => [
                    'tablenames' => 'tx_chfbase_domain_model_agent',
                    'fieldname' => 'licence_relation',
                ],
                'MM_opposite_field' => 'record',
                'multiple' => 1,
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
                'overrideChildTca' => [
                    'columns' => [
                        'type' => [
                            'config' => [
                                'default' => 'licenceRelation',
                                'readOnly' => true,
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'editorial_steps' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.editorialSteps',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.editorialSteps.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectCheckBox',
                'items' => [
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.editorialSteps.checkDatabase',
                        'value' => 'checkDatabase',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.editorialSteps.checkStandard',
                        'value' => 'checkStandard',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.editorialSteps.checkForeignLanguage',
                        'value' => 'checkForeignLanguage',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.editorialSteps.checkPrevious',
                        'value' => 'checkPrevious',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.editorialSteps.checkFurther',
                        'value' => 'checkFurther',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.editorialSteps.checkAuthorityFiles',
                        'value' => 'checkAuthorityFiles',
                    ],
                ],
            ],
        ],
        'publication_steps' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.publicationSteps',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.publicationSteps.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectCheckBox',
                'items' => [
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.publicationSteps.started',
                        'value' => 'started',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.publicationSteps.edited',
                        'value' => 'edited',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.publicationSteps.checked',
                        'value' => 'checked',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.publicationSteps.deferred',
                        'value' => 'deferred',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.publicationSteps.revised',
                        'value' => 'revised',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.publicationSteps.publicationReady',
                        'value' => 'publicationReady',
                    ],
                ],
            ],
        ],
        'import_origin' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.importOrigin',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.importOrigin.description',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
            ],
        ],
        'import' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'max' => 100000,
                'eval' => 'trim',
            ],
        ],
        'as_agent_of_agent_relation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.asAgentOfAgentRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.asAgentOfAgentRelation.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_relation}.{#pid}=###CURRENT_PID###'
                #'foreign_table_where' => 'AND {#tx_chfbase_domain_model_relation}.{#parent_resource}=###REC_FIELD_parent_resource###'
                    . ' AND {#tx_chfbase_domain_model_relation}.{#type}=\'agentRelation\'',
                'MM' => 'tx_chfbase_domain_model_relation_agent_agent_mm',
                'MM_opposite_field' => 'agent',
                'multiple' => 1,
                'size' => 5,
                'autoSizeMax' => 10,
            ],
        ],
        'as_contributor_of_authorship_relation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.asContributorOfAuthorshipRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agent.asContributorOfAuthorshipRelation.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_relation}.{#pid}=###CURRENT_PID###'
                #'foreign_table_where' => 'AND {#tx_chfbase_domain_model_relation}.{#parent_resource}=###REC_FIELD_parent_resource###'
                    . ' AND {#tx_chfbase_domain_model_relation}.{#type}=\'authorshipRelation\'',
                'MM' => 'tx_chfbase_domain_model_relation_agent_contributor_mm',
                'MM_opposite_field' => 'contributor',
                'multiple' => 1,
                'size' => 5,
                'autoSizeMax' => 10,
            ],
        ],
    ],
    'palettes' => [
        'forenameSurnameCorporateNameAlternativeName' => [
            'showitem' => 'forename,surname,--linebreak--,corporate_name,alternative_name,',
        ],
        'honorificOccupation' => [
            'showitem' => 'honorific,occupation,',
        ],
        'genderLabel' => [
            'showitem' => 'gender,label,',
        ],
        'eventAgentRelationLocationRelation' => [
            'showitem' => 'event,--linebreak--,agentRelation,--linebreak--,location_relation,',
        ],
        'contentElementFootnote' => [
            'showitem' => 'content_element,--linebreak--,footnote,',
        ],
        'mediaFile' => [
            'showitem' => 'media,--linebreak--,file,',
        ],
        'sourceRelationLinkRelation' => [
            'showitem' => 'source_relation,--linebreak--,link_relation,',
        ],
        'isTeaserIsHighlightIsContributor' => [
            'showitem' => 'is_teaser,is_highlight,is_contributor,',
        ],
        'parentAgentParentResource' => [
            'showitem' => 'parent_agent,parent_resource,',
        ],
        'iriUuidSameAs' => [
            'showitem' => 'iri,uuid,--linebreak--,same_as,',
        ],
        'publicationDateRevisionDateRevisionNumberEditorialNote' => [
            'showitem' => 'publication_date,revision_date,revision_number,--linebreak--,editorial_note,',
        ],
        'authorshipRelationLicenceRelation' => [
            'showitem' => 'authorship_relation,--linebreak--,licence_relation,',
        ],
        'editorialStepsPublicationSteps' => [
            'showitem' => 'editorial_steps,publication_steps,',
        ],
        'importOriginImport' => [
            'showitem' => 'import_origin,--linebreak--,import,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'type,--palette--;;forenameSurnameCorporateNameAlternativeName,--palette--;;honorificOccupation,--palette--;;genderLabel,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,agent,--palette--;;eventAgentRelationLocationRelation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.unstructured,--palette--;;contentElementFootnote,--palette--;;mediaFile,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.bibliography,--palette--;;sourceRelationLinkRelation,publication_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.placement,--palette--;;isTeaserIsHighlightIsContributor,--palette--;;parentAgentParentResource,--palette--;;iriUuidSameAs,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.editorial,--palette--;;publicationDateRevisionDateRevisionNumberEditorialNote,--palette--;;authorshipRelationLicenceRelation,--palette--;;editorialStepsPublicationSteps,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import,--palette--;;importOriginImport,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.usage,as_agent_of_agent_relation,as_contributor_of_authorship_relation,',
        ],
    ],
];
