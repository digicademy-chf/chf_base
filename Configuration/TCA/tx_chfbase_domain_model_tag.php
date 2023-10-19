<?php

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


/**
 * Tag and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractTag',
        'label'                    => 'text',
        'label_alt'                => 'code,type',
        'descriptionColumn'        => 'description',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'text ASC,code ASC,type ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_base/Resources/Public/Icons/Tag.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
        'type'                     => 'type',
        'searchFields'             => 'uuid,type,code,text,description',
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
                'foreign_table' => 'tx_chfbase_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_tag}.{#sys_language_uid} IN (-1,0)',
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
        'parentResource' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.parentResource',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.parentResource.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_chfbase_domain_model_resource',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_resource}.{#pid}=###CURRENT_PID###',
                'maxitems' => 1,
                'sortItems' => [
                    'label' => 'asc',
                ],
                'behaviour' => [
                     'allowLanguageSynchronization' => true
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
                     'allowLanguageSynchronization' => true
                ],
                'required' => true,
            ],
        ],
        'type' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractTag.type',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractTag.type.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractTag.type.labelTag',
                        'value' => 'labelTag',
                        'group' => 'chfBase',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractTag.type.labelTypeTag',
                        'value' => 'labelTypeTag',
                        'group' => 'chfBase',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractTag.type.licenceTag',
                        'value' => 'licenceTag',
                        'group' => 'chfBase',
                    ],
                ],
                'itemGroups' => [
                    'chfBase' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractTag.type.chfBase',
                ],
                'sortItems' => [
                    'label' => 'asc',
                ],
                'behaviour' => [
                     'allowLanguageSynchronization' => true
                ],
                'required' => true,
            ],
        ],
        'parentLabelTag' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.labelTag.parentLabelTag',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.labelTag.parentLabelTag.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectTree',
                'foreign_table' => 'tx_chfbase_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_tag}.{#type}="labelTag" AND {#tx_chfbase_domain_model_tag}.{#pid}=###CURRENT_PID###',
                'treeConfig' => [
                    'parentField' => 'parentLabelTag',
                ],
                'maxitems' => 1,
                'behaviour' => [
                     'allowLanguageSynchronization' => true
                ],
            ],
        ],
        'labelType' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.labelTag.labelType',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.labelTag.labelType.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_chfbase_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_tag}.{#type}="labelTypeTag" AND {#tx_chfbase_domain_model_tag}.{#pid}=###CURRENT_PID###',
                'maxitems' => 1,
                'items' => [
                    [
                        'label' => '',
                        'value' => '0',
                    ],
                ],
                'sortItems' => [
                    'label' => 'asc',
                ],
                'behaviour' => [
                     'allowLanguageSynchronization' => true
                ],
            ],
        ],
        'code' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractTag.code',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractTag.code.description',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
                'behaviour' => [
                     'allowLanguageSynchronization' => true
                ],
                'required' => true,
            ],
        ],
        'text' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractTag.text',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractTag.text.description',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
                'behaviour' => [
                     'allowLanguageSynchronization' => true
                ],
                'required' => true,
            ],
        ],
        'description' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractTag.description',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractTag.description.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 5,
                'max' => 2000,
                'eval' => 'trim',
                'behaviour' => [
                     'allowLanguageSynchronization' => true
                ],
            ],
        ],
        'sameAs' => [
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.sameAs',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.sameAs.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_same_as',
                'foreign_field' => 'parent_id',
                'foreign_table_field' => 'parent_table',
                'behaviour' => [
                     'allowLanguageSynchronization' => true
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
        'asLabelOfAgent' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.labelTag.asLabelOfAgent',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.labelTag.asLabelOfAgent.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_agent',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_agent}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_agent_tag_label_mm',
                'MM_opposite_field'   => 'label',
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
        'asLabelOfLocation' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.labelTag.asLabelOfLocation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.labelTag.asLabelOfLocation.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_location',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_location}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_location_tag_label_mm',
                'MM_opposite_field'   => 'label',
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
        'asLabelOfPeriod' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.labelTag.asLabelOfPeriod',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.labelTag.asLabelOfPeriod.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_period',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_period}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_period_tag_label_mm',
                'MM_opposite_field'   => 'label',
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
        'asLabelTypeOfLabelTag' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.labelTypeTag.asLabelTypeOfLabelTag',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.labelTypeTag.asLabelTypeOfLabelTag.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_tag}.{#type}="labelType" AND {#tx_chfbase_domain_model_tag}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_tag_tag_labeltype_mm',
                'MM_opposite_field'   => 'labelType',
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
        'asLicenceOfMetadataOfResource' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.licenceTag.asLicenceOfMetadataOfResource',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.licenceTag.asLicenceOfMetadataOfResource.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_resource',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_resource}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_resource_tag_licenceofmetadata_mm',
                'MM_opposite_field'   => 'licenceOfMetadata',
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
        'asLicenceOfTextOfResource' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.licenceTag.asLicenceOfTextOfResource',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.licenceTag.asLicenceOfTextOfResource.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_resource',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_resource}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_resource_tag_licenceoftext_mm',
                'MM_opposite_field'   => 'licenceOfText',
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
        'asLicenceOfMediaOfResource' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.licenceTag.asLicenceOfMediaOfResource',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.licenceTag.asLicenceOfMediaOfResource.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_resource',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_resource}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_resource_tag_licenceofmedia_mm',
                'MM_opposite_field'   => 'licenceOfMedia',
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
        'asLicenceOfMetadataOfAgent' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.licenceTag.asLicenceOfMetadataOfAgent',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.licenceTag.asLicenceOfMetadataOfAgent.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_agent',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_agent}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_agent_tag_licenceofmetadata_mm',
                'MM_opposite_field'   => 'licenceOfMetadata',
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
        'asLicenceOfTextOfAgent' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.licenceTag.asLicenceOfTextOfAgent',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.licenceTag.asLicenceOfTextOfAgent.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_agent',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_agent}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_agent_tag_licenceoftext_mm',
                'MM_opposite_field'   => 'licenceOfText',
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
        'asLicenceOfMediaOfAgent' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.licenceTag.asLicenceOfMediaOfAgent',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.licenceTag.asLicenceOfMediaOfAgent.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_agent',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_agent}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_agent_tag_licenceofmedia_mm',
                'MM_opposite_field'   => 'licenceOfMedia',
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
        'asLicenceOfMetadataOfLocation' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.licenceTag.asLicenceOfMetadataOfLocation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.licenceTag.asLicenceOfMetadataOfLocation.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_location',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_location}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_location_tag_licenceofmetadata_mm',
                'MM_opposite_field'   => 'licenceOfMetadata',
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
        'asLicenceOfTextOfLocation' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.licenceTag.asLicenceOfTextOfLocation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.licenceTag.asLicenceOfTextOfLocation.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_location',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_location}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_location_tag_licenceoftext_mm',
                'MM_opposite_field'   => 'licenceOfText',
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
        'asLicenceOfMediaOfLocation' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.licenceTag.asLicenceOfMediaOfLocation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.licenceTag.asLicenceOfMediaOfLocation.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_location',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_location}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_location_tag_licenceofmedia_mm',
                'MM_opposite_field'   => 'licenceOfMedia',
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
        'asLicenceOfMetadataOfPeriod' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.licenceTag.asLicenceOfMetadataOfPeriod',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.licenceTag.asLicenceOfMetadataOfPeriod.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_period',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_period}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_period_tag_licenceofmetadata_mm',
                'MM_opposite_field'   => 'licenceOfMetadata',
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
        'asLicenceOfTextOfPeriod' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.licenceTag.asLicenceOfTextOfPeriod',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.licenceTag.asLicenceOfTextOfPeriod.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_period',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_period}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_period_tag_licenceoftext_mm',
                'MM_opposite_field'   => 'licenceOfText',
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
        'asLicenceOfMediaOfPeriod' => [
            'label'       => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.licenceTag.asLicenceOfMediaOfPeriod',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.licenceTag.asLicenceOfMediaOfPeriod.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chfbase_domain_model_period',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_period}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chfbase_domain_model_period_tag_licenceofmedia_mm',
                'MM_opposite_field'   => 'licenceOfMedia',
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
        'hiddenParentResource' => [
            'showitem' => 'hidden,parentResource,',
        ],
        'uuidType' => [
            'showitem' => 'uuid,type,',
        ],
        'parentLabelTagLabelType' => [
            'showitem' => 'parentLabelTag,labelType,',
        ],
        'codeText' => [
            'showitem' => 'code,text,',
        ],
    ],
    'types' => [
        'abstractTag' => [
            'showitem' => 'hiddenParentResource,uuidType,codeText,description,sameAs,',
        ],
        'labelTag' => [
            'showitem' => 'hiddenParentResource,uuidType,parentLabelTagLabelType,codeText,description,sameAs,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.usage,asLabelOfAgent,asLabelOfLocation,asLabelOfPeriod,',
        ],
        'labelTypeTag' => [
            'showitem' => 'hiddenParentResource,uuidType,codeText,description,sameAs,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.usage,asLabelTypeOfLabelTag,',
        ],
        'licenceTag' => [
            'showitem' => 'hiddenParentResource,uuidType,codeText,description,sameAs,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.usage,asLicenceOfMetadataOfResource,asLicenceOfTextOfResource,asLicenceOfMediaOfResource,asLicenceOfMetadataOfAgent,asLicenceOfTextOfAgent,asLicenceOfMediaOfAgent,asLicenceOfMetadataOfLocation,asLicenceOfTextOfLocation,asLicenceOfMediaOfLocation,asLicenceOfMetadataOfPeriod,asLicenceOfTextOfPeriod,asLicenceOfMediaOfPeriod,',
        ],
    ],
];

?>
