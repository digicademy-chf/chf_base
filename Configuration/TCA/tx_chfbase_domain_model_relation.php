<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * AbstractRelation and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation',
        'label'                    => 'uuid',
        'descriptionColumn'        => 'description',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'uuid ASC,type ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_base/Resources/Public/Icons/Relation.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'uuid,type,description',
        'type'                     => 'type',
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
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_relation}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_relation}.{#sys_language_uid} IN (-1,0)',
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
        'parentResource' => [
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
        'type' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.type',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.type.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.type.authorshipRelation',
                        'value' => 'authorshipRelation',
                        'group' => 'chfBase',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.type.locationRelation',
                        'value' => 'locationRelation',
                        'group' => 'chfBase',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.type.agentRelation',
                        'value' => 'agentRelation',
                        'group' => 'chfBase',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.type.licenceRelation',
                        'value' => 'licenceRelation',
                        'group' => 'chfBase',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.type.linkRelation',
                        'value' => 'linkRelation',
                        'group' => 'chfBase',
                    ],
                ],
                'itemGroups' => [
                    'chfBase' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.chfBase',
                ],
                'required' => true,
            ],
        ],
        'record' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.record',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.record.description',
            'config' => [
                'type' => 'group',
                'allowed' => 'tx_chfbase_domain_model_resource,tx_chfbase_domain_model_agent,tx_chfbase_domain_model_location,tx_chfbase_domain_model_period,tx_chfbib_domain_model_bibliographic_entry,tx_chflex_domain_model_dictionary_entry,tx_chflex_domain_model_encyclopedia_entry,tx_chflex_domain_model_frequency,tx_chflex_domain_model_example,tx_chfmap_domain_model_feature,tx_chfpub_domain_model_volume,tx_chfpub_domain_model_essay,tx_chfobject_domain_model_object_group,tx_chfobject_domain_model_single_object,tx_chfmedia_domain_model_file_group,sys_file_metadata,',
                'foreign_table' => 'tx_chfbase_domain_model_resource', // Needed by Extbase as of TYPO3 12, remove when possible
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'multiple' => 1,
                'elementBrowserEntryPoints' => [
                    '_default' => '###CURRENT_PID###',
                ],
                'required' => true,
            ],
        ],
        'agent' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agentRelation.agent',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.agentRelation.agent.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingleBox',
                'foreign_table' => 'tx_chfbase_domain_model_agent',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_agent}.{#pid}=###CURRENT_PID###',
                'MM' => 'tx_chfbase_domain_model_relation_agent_agent_mm',
                'multiple' => 1,
                'sortItems' => [
                    'label' => 'asc',
                ],
                'required' => true,
            ],
        ],
        'contributor' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.authorshipRelation.contributor',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.authorshipRelation.contributor.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingleBox',
                'foreign_table' => 'tx_chfbase_domain_model_agent',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_agent}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_agent}.{#isContributor}=TRUE',
                'MM' => 'tx_chfbase_domain_model_relation_agent_contributor_mm',
                'multiple' => 1,
                'sortItems' => [
                    'label' => 'asc',
                ],
                'required' => true,
            ],
        ],
        'location' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.locationRelation.location',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.locationRelation.location.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingleBox',
                'foreign_table' => 'tx_chfbase_domain_model_location',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_location}.{#pid}=###CURRENT_PID###',
                'MM' => 'tx_chfbase_domain_model_relation_location_location_mm',
                'multiple' => 1,
                'sortItems' => [
                    'label' => 'asc',
                ],
                'required' => true,
            ],
        ],
        'licence' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.licenceRelation.licence',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.licenceRelation.licence.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingleBox',
                'foreign_table' => 'tx_chfbase_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_tag}.{#type}=\'licenceTag\'',
                'MM' => 'tx_chfbase_domain_model_relation_tag_licence_mm',
                'multiple' => 1,
                'sortItems' => [
                    'label' => 'asc',
                ],
                'required' => true,
            ],
        ],
        'role' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [],
                'required' => true,
            ],
        ],
        'url' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.linkRelation.url',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.linkRelation.url.description',
            'config' => [
                'type' => 'link',
                'allowedTypes' => ['url'],
                'allowedOptions' => [],
                'mode' => 'prepend',
                'valuePicker' => [
                   'items' => [
                      ['HTTPS', 'https://'],
                      ['HTTP', 'http://'],
                   ],
                ],
                'required' => true,
            ],
        ],
        'linkText' => [
            'exclude' => true,
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.linkRelation.linkText',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.linkRelation.linkText.description',
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
        'lastChecked' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.linkRelation.lastChecked',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.linkRelation.lastChecked.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'eval' => 'int',
                'default' => 0,
            ],
        ],
        'description' => [
            'exclude' => true,
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.description',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.description.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 8,
                'max' => 2000,
                'eval' => 'trim',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
    ],
    'palettes' => [
        'typeUuid' => [
            'showitem' => 'type,uuid,',
        ],
        'contributorRole' => [
            'showitem' => 'contributor,role,',
        ],
        'locationRole' => [
            'showitem' => 'location,role,',
        ],
        'agentRole' => [
            'showitem' => 'agent,role,',
        ],
        'licenceRole' => [
            'showitem' => 'licence,role,',
        ],
        'urlLinkTextLastChecked' => [
            'showitem' => 'url,--linebreak--,linkText,lastChecked,',
        ],
        'parentResourceDescription' => [
            'showitem' => 'parentResource,description,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => '--palette--;;typeUuid,--palette--;;parentResourceDescription,',
        ],
        'authorshipRelation' => [
            'showitem' => '--palette--;;typeUuid,record,--palette--;;contributorRole,--palette--;;parentResourceDescription,',
            'columnsOverrides' => [
                'role' => [
                    'config' => [
                        'items' => [
                            [
                                'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.author',
                                'value' => 'author',
                            ],
                            [
                                'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.editor',
                                'value' => 'editor',
                            ],
                            [
                                'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.translator',
                                'value' => 'translator',
                            ],
                            [
                                'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.contributor',
                                'value' => 'contributor',
                            ],
                            [
                                'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.publisher',
                                'value' => 'publisher',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'locationRelation' => [
            'showitem' => '--palette--;;typeUuid,record,--palette--;;locationRole,--palette--;;parentResourceDescription,',
            'columnsOverrides' => [
                'role' => [
                    'config' => [
                        'items' => [
                            [
                                'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.currentLocation',
                                'value' => 'currentLocation',
                            ],
                            [
                                'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.formerLocation',
                                'value' => 'formerLocation',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'agentRelation' => [
            'showitem' => '--palette--;;typeUuid,record,--palette--;;agentRole,--palette--;;parentResourceDescription,',
            'columnsOverrides' => [
                'role' => [
                    'config' => [
                        'items' => [
                            [
                                'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.agency',
                                'value' => 'agency',
                            ],
                            [
                                'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.relationship',
                                'value' => 'relationship',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'licenceRelation' => [
            'showitem' => '--palette--;;typeUuid,record,--palette--;;licenceRole,--palette--;;parentResourceDescription,',
            'columnsOverrides' => [
                'role' => [
                    'config' => [
                        'items' => [
                            [
                                'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.allContent',
                                'value' => 'allContent',
                            ],
                            [
                                'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.metadata',
                                'value' => 'metadata',
                            ],
                            [
                                'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.text',
                                'value' => 'text',
                            ],
                            [
                                'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.media',
                                'value' => 'media',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'linkRelation' => [
            'showitem' => '--palette--;;typeUuid,record,--palette--;;urlLinkTextLastChecked,--palette--;;parentResourceDescription,',
        ],
    ],
];
