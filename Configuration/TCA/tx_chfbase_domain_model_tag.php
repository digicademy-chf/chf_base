<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * AbstractTag and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractTag',
        'label'                    => 'code',
        'label_alt'                => 'text',
        'label_alt_force'          => true,
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'code ASC,text ASC,type ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_base/Resources/Public/Icons/TableTag.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'type,text,code,description,iri,uuid',
        'type'                     => 'type',
        'enablecolumns'            => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
            'fe_group' => 'fe_group',
        ],
    ],
    'columns' => [
        'type' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
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
                    'chfBase' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.chfBase',
                ],
                'sortItems' => [
                    'label' => 'asc',
                ],
                'default' => 'labelTag',
                'required' => true,
            ],
        ],
        'label_type' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.labelTag.labelType',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.labelTag.labelType.description',
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
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_tag}.{#sys_language_uid} IN (-1, 0)'
                    . ' AND {#tx_chfbase_domain_model_tag}.{#pid} IN (###CURRENT_PID###, ###SITE:settings.chf.data.page###)'
                    . ' AND {#tx_chfbase_domain_model_tag}.{#type}=\'labelTypeTag\'',
                'MM' => 'tx_chfbase_domain_model_tag_record_mm',
                'MM_match_fields' => [
                    'fieldname' => 'label_type',
                    'tablenames' => 'tx_chfbase_domain_model_tag',
                ],
                'MM_opposite_field' => 'items',
                'sortItems' => [
                    'label' => 'asc',
                ],
            ],
        ],
        'text' => [
            'exclude' => true,
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractTag.text',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractTag.text.description',
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
        'code' => [
            'exclude' => true,
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractTag.code',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractTag.code.description',
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
        'description' => [
            'exclude' => true,
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractTag.description',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractTag.description.description',
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
        'keyword' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.labelTag.keyword',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.labelTag.keyword.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfbase_domain_model_keyword',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_keyword}.{#sys_language_uid} IN (-1, 0)'
                    . ' AND {#tx_chfbase_domain_model_keyword}.{#pid} IN (###CURRENT_PID###, ###SITE:settings.chf.data.page###)',
                'size' => 5,
                'autoSizeMax' => 10,
                'fieldControl' => [
                    'addRecord' => [
                        'disabled' => false,
                    ],
                ],
            ],
        ],
        'items' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractTag.items',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractTag.items.description',
            'config' => [
                'type' => 'group',
                'allowed' => '*',
                'MM' => 'tx_chfbase_domain_model_tag_record_mm',
                'MM_oppositeUsage' => [
                    'tx_chfbase_domain_model_agent' => ['label'],
                    'tx_chfbase_domain_model_location' => ['label'],
                    'tx_chfbase_domain_model_period' => ['label'],
                    'tx_chfbase_domain_model_relation' => ['licence'],
                    'tx_chfbase_domain_model_tag' => ['label_type'],
                ],
                'fieldWizard' => [
                    'recordsOverview' => [
                        'disabled' => true,
                    ],
                ],
            ],
        ],
        'parent_label_tag' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.labelTag.parentLabelTag',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.labelTag.parentLabelTag.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectTree',
                'foreign_table' => 'tx_chfbase_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_tag}.{#sys_language_uid} IN (-1, 0)'
                    . ' AND {#tx_chfbase_domain_model_tag}.{#pid} IN (###CURRENT_PID###, ###SITE:settings.chf.data.page###)'
                    . ' AND {#tx_chfbase_domain_model_tag}.{#type}=\'labelTag\'',
                'treeConfig' => [
                    'parentField' => 'parent_label_tag',
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
            'onChange' => 'reload',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingleBox',
                'foreign_table' => 'tx_chfbase_domain_model_resource',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_resource}.{#sys_language_uid} IN (-1, 0)',
                'MM' => 'tx_chfbase_domain_model_resource_record_mm',
                'MM_match_fields' => [
                    'fieldname' => 'parent_resource',
                    'tablenames' => 'tx_chfbase_domain_model_tag',
                ],
                'MM_opposite_field' => 'items',
                'sortItems' => [
                    'label' => 'asc',
                ],
            ],
        ],
        'iri' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.iri',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.iri.description',
            'config' => [
                'type' => 'slug',
                'size' => 40,
                'appearance' => [
                    'prefix' => 'Digicademy\CHFBase\UserFunctions\FormEngine\SlugPrefix->getPrefix',
                ],
                'prependSlash' => false,
                'generatorOptions' => [
                    'prefixParentPageSlug' => false,
                    'replacements' => [
                        '/' => '',
                    ],
                ],
                'default' => 't',
                'eval' => 'uniqueInSite',
                'fallbackCharacter' => '',
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
        'same_as' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.sameAs',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.sameAs.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_sameas',
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
    ],
    'palettes' => [
        'typeLabelType' => [
            'showitem' => 'type,label_type,',
        ],
        'textCode' => [
            'showitem' => 'text,code,',
        ],
        'parentLabelTagParentResource' => [
            'showitem' => 'parent_label_tag,parent_resource,',
        ],
        'iriUuid' => [
            'showitem' => 'iri,uuid,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'type,--palette--;;textCode,description,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,items,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,parent_resource,--palette--;;iriUuid,same_as,',
        ],
        'labelTag' => [
            'showitem' => '--palette--;;typeLabelType,--palette--;;textCode,description,keyword,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,items,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,--palette--;;parentLabelTagParentResource,--palette--;;iriUuid,same_as,',
        ],
        'labelTypeTag' => [
            'showitem' => 'type,--palette--;;textCode,description,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,items,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,parent_resource,--palette--;;iriUuid,same_as,',
        ],
        'licenceTag' => [
            'showitem' => 'type,--palette--;;textCode,description,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,items,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,parent_resource,--palette--;;iriUuid,same_as,',
        ],
    ],
];
