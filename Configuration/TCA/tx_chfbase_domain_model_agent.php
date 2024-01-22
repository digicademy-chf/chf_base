<?php

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


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
        'label_alt'                => 'forename,corporateName,alternativeName,type',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'isHighlight ASC,surname ASC,forename ASC,corporateName ASC,alternativeName ASC,type ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_base/Resources/Public/Icons/Agent.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'uuid,type,forename,surname,corporateName,alternativeName,honorific,occupation,gender,publicationDate,revisionNumber,revisionDate,editorialNote,importOrigin,import',
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
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'foreign_match_fields' => [
                    'type' => 'authorshipRelation',
                ],
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
        'licenceRelation' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.licenceRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.licenceRelation.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'foreign_match_fields' => [
                    'type' => 'licenceRelation',
                ],
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
        'publicationDate' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.publicationDate',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.publicationDate.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'eval' => 'int',
                'default' => 0,
            ],
            'behaviour' => [
                'allowLanguageSynchronization' => true,
            ],
        ],
        'revisionNumber' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionNumber',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionNumber.description',
            'config' => [
                'type' => 'number',
            ],
            'behaviour' => [
                'allowLanguageSynchronization' => true,
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
            ],
            'behaviour' => [
                'allowLanguageSynchronization' => true,
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
            ],
            'behaviour' => [
                'allowLanguageSynchronization' => true,
            ],
        ],
        'importOrigin' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.importOrigin',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.importOrigin.description',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
            ],
            'behaviour' => [
                'allowLanguageSynchronization' => true,
            ],
        ],















        
        'parent_id' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.parent_id',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.parent_id.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_chfbase_domain_model_resource',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_resource}.{#pid}=###CURRENT_PID###',
                'maxitems'            => 1,
                'required'            => true,
            ],
        ],
        'uuid' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.uuid',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.uuid.description',
            'config'      => [
                'type'     => 'uuid',
                'size'     => 40,
                'required' => true,
            ],
        ],
        'type' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.type',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.type.description',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'items'      => [
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.type.person',
                        'value' => 'person',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.type.organisation',
                        'value' => 'organisation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.type.otherEntity',
                        'value' => 'otherEntity',
                    ],
                ],
            ],
        ],
        'forename' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.forename',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.forename.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'surname' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.surname',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.surname.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'corporateName' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.corporateName',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.corporateName.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'alternativeName' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.alternativeName',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.alternativeName.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'honorific' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.honorific',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.honorific.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'occupation' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.occupation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.occupation.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'gender' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.gender',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.gender.description',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'items'      => [
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.gender.unspecified',
                        'value' => 'unspecified',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.gender.female',
                        'value' => 'female',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.gender.male',
                        'value' => 'male',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.gender.nonBinary',
                        'value' => 'nonBinary',
                    ],
                ],
            ],
        ],
        'isContributor' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.isContributor',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.isContributor.description',
            'config'  => [
                'type'       => 'check',
                'renderType' => 'checkboxToggle',
                'items'      => [
                    [
                        'label' => ''
                    ]
                ],
            ]
        ],
        'isHighlight' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.isHighlight',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.isHighlight.description',
            'config'  => [
                'type'       => 'check',
                'renderType' => 'checkboxToggle',
                'items'      => [
                    [
                        'label' => ''
                    ]
                ],
            ]
        ],
        'label' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.label',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.label.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_tag}.{#type}=\'label\'',
                'MM'                  => 'tx_chfbase_domain_model_agent_tag_label_mm',
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
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.sameAs',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.sameAs.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chfbase_domain_model_same_as',
                'foreign_field'       => 'parent_id',
                'foreign_table_field' => 'parent_table',
                'behaviour'           => [
                    'allowLanguageSynchronization' => true,
                ],
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
        'author' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.author',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.author.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_agent',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_agent}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_agent_agent_author_mm',
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
        'editor' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.editor',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.editor.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_agent',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_agent}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_agent_agent_editor_mm',
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
        'translator' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.translator',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.translator.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_agent',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_agent}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_agent_agent_translator_mm',
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
        'genericContributor' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.genericContributor',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.genericContributor.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_agent',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_agent}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_agent_agent_genericcontributor_mm',
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
        'contentElement' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.contentElement',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.contentElement.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tt_content',
                'foreign_field'       => 'parent_id',
                'foreign_table_field' => 'parent_table',
                'behaviour'           => [
                    'allowLanguageSynchronization' => true,
                ],
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
        'image' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.image',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.image.description',
            'config' => [
                'type'     => 'file',
                'allowed'  => 'common-image-types'
            ],
        ],
        'file' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.file',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.file.description',
            'config' => [
                'type'     => 'file',
                'allowed'  => 'common-text-types'
            ],
        ],
        'event' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.event',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.event.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chfbase_domain_model_period',
                'foreign_field'       => 'parent_id',
                'foreign_table_field' => 'parent_table',
                'behaviour'           => [
                    'allowLanguageSynchronization' => true,
                ],
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
        'lifePeriod' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.lifePeriod',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.lifePeriod.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chfbase_domain_model_date',
                'foreign_field'       => 'parent_id',
                'foreign_table_field' => 'parent_table',
                'maxitems'            => 1,
                'behaviour'           => [
                    'allowLanguageSynchronization' => true,
                ],
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
        'lifeLocation' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.lifeLocation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.lifeLocation.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chfbase_domain_model_location',
                'foreign_field'       => 'parent_id',
                'foreign_table_field' => 'parent_table',
                'behaviour'           => [
                    'allowLanguageSynchronization' => true,
                ],
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
        'activePeriod' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.activePeriod',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.activePeriod.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chfbase_domain_model_date',
                'foreign_field'       => 'parent_id',
                'foreign_table_field' => 'parent_table',
                'maxitems'            => 1,
                'behaviour'           => [
                    'allowLanguageSynchronization' => true,
                ],
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
        'activeLocation' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.activeLocation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.activeLocation.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chfbase_domain_model_location',
                'foreign_field'       => 'parent_id',
                'foreign_table_field' => 'parent_table',
                'behaviour'           => [
                    'allowLanguageSynchronization' => true,
                ],
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
        'source' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.source',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.source.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chfbib_domain_model_reference',
                'foreign_field'       => 'parent_id',
                'foreign_table_field' => 'parent_table',
                'behaviour'           => [
                    'allowLanguageSynchronization' => true,
                ],
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
        'importOrigin' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.importOrigin',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.importOrigin.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'import' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.import',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.import.description',
            'config'      => [
                'type'     => 'text',
                'cols'     => 40,
                'rows'     => 15,
                'max'      => 100000,
                'eval'     => 'trim',
            ],
        ],
        'asAuthorOfResource' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asAuthorOfResource',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asAuthorOfResource.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_resource',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_resource}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_resource_agent_author_mm',
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
        'asEditorOfResource' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asEditorOfResource',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asEditorOfResource.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_resource',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_resource}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_resource_agent_editor_mm',
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
        'asTranslatorOfResource' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asTranslatorOfResource',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asTranslatorOfResource.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_resource',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_resource}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_resource_agent_translator_mm',
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
        'asGenericContributorOfResource' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asGenericContributorOfResource',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asGenericContributorOfResource.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_resource',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_resource}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_resource_agent_genericcontributor_mm',
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
        'asAuthorOfAgent' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asAuthorOfAgent',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asAuthorOfAgent.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_agent',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_agent}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_agent_agent_author_mm',
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
        'asEditorOfAgent' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asEditorOfAgent',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asEditorOfAgent.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_agent',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_agent}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_agent_agent_editor_mm',
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
        'asTranslatorOfAgent' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asTranslatorOfAgent',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asTranslatorOfAgent.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_agent',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_agent}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_agent_agent_translator_mm',
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
        'asGenericContributorOfAgent' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asGenericContributorOfAgent',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asGenericContributorOfAgent.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_agent',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_agent}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_agent_agent_genericcontributor_mm',
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
        'asAuthorOfPeriod' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asAuthorOfPeriod',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asAuthorOfPeriod.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_date',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_date}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_date_agent_author_mm',
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
        'asEditorOfPeriod' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asEditorOfPeriod',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asEditorOfPeriod.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_date',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_date}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_date_agent_editor_mm',
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
        'asTranslatorOfPeriod' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asTranslatorOfPeriod',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asTranslatorOfPeriod.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_date',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_date}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_date_agent_translator_mm',
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
        'asGenericContributorOfPeriod' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asGenericContributorOfPeriod',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asGenericContributorOfPeriod.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_date',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_date}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_date_agent_genericcontributor_mm',
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
        'asAuthorOfLocation' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asAuthorOfLocation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asAuthorOfLocation.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_location',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_location}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_location_agent_author_mm',
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
        'asEditorOfLocation' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asEditorOfLocation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asEditorOfLocation.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_location',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_location}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_location_agent_editor_mm',
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
        'asTranslatorOfLocation' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asTranslatorOfLocation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asTranslatorOfLocation.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_location',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_location}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_location_agent_translator_mm',
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
        'asGenericContributorOfLocation' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asGenericContributorOfLocation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.asGenericContributorOfLocation.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_location',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_location}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_location_agent_genericcontributor_mm',
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
        'uuidType' => [
            'showitem' => 'uuid,type,',
        ],
        'forenameSurname' => [
            'showitem' => 'forename,surname,',
        ],
        'corporateNameAlternativeName' => [
            'showitem' => 'corporateNameAlternativeName,',
        ],
        'honorificOccupationGender' => [
            'showitem' => 'honorific,occupation,gender,',
        ],
        'isContributorIsHighlight' => [
            'showitem' => 'isContributor,isHighlight,',
        ],
        'publicationDateRevisionNumberRevisionDate' => [
            'showitem' => 'publicationDate,revisionNumber,revisionDate,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'hiddenParentId,uuidType,forenameSurname,corporateNameAlternativeName,honorificOccupationGender,isContributorIsHighlight,label,sameAs,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.editorial,author,editor,translator,genericContributor,publicationDateRevisionNumberRevisionDate,editorialNote,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.content,contentElement,image,file,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.life,event,lifePeriod,lifeLocation,activePeriod,activeLocation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.bibliography,source,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.original,importOrigin,import,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:database.agent.relations,asAuthorOfResource,asEditorOfResource,asTranslatorOfResource,asGenericContributorOfResource,asAuthorOfAgent,asEditorOfAgent,asTranslatorOfAgent,asGenericContributorOfAgent,asAuthorOfPeriod,asEditorOfPeriod,asTranslatorOfPeriod,asGenericContributorOfPeriod,asAuthorOfLocation,asEditorOfLocation,asTranslatorOfLocation,asGenericContributorOfLocation,',
        ],
    ],
];

?>
