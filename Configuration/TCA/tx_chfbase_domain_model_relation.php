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
        'label_alt'                => 'type',
        'label_alt_force'          => true,
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'uuid ASC,type ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_base/Resources/Public/Icons/TableRelation.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'type,description,iri,uuid',
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
                'default' => 'authorshipRelation',
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
                'allowed' => 'tx_chfbase_domain_model_resource,tx_chfbase_domain_model_agent,tx_chfbase_domain_model_location,tx_chfbase_domain_model_period,tx_chfbib_domain_model_bibliographicentry,tx_chflex_domain_model_dictionaryentry,tx_chflex_domain_model_encyclopediaentry,tx_chflex_domain_model_frequency,tx_chflex_domain_model_example,tx_chfmap_domain_model_feature,tx_chfpub_domain_model_volume,tx_chfpub_domain_model_essay,tx_chfobject_domain_model_objectgroup,tx_chfobject_domain_model_singleobject,tx_chfmedia_domain_model_filegroup,sys_file_metadata,',
                'maxitems' => 1,
                'size' => 1,
                'elementBrowserEntryPoints' => [
                    '_default' => '###CURRENT_PID###',
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
                'renderType' => 'selectTree',
                'foreign_table' => 'tx_chfbase_domain_model_agent',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_agent}.{#sys_language_uid} IN (-1, 0)'
                    . ' AND {#tx_chfbase_domain_model_agent}.{#type}=\'contributor\'',
                'treeConfig' => [
                    'parentField' => 'parent_agent',
                    'appearance' => [
                        'showHeader' => true,
                        'expandAll' => true,
                    ],
                ],
                'size' => 8,
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
                'renderType' => 'selectTree',
                'foreign_table' => 'tx_chfbase_domain_model_location',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_location}.{#sys_language_uid} IN (-1, 0)',
                'treeConfig' => [
                    'parentField' => 'parent_location',
                    'appearance' => [
                        'showHeader' => true,
                        'expandAll' => true,
                    ],
                ],
                'size' => 8,
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
                'renderType' => 'selectTree',
                'foreign_table' => 'tx_chfbase_domain_model_agent',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_agent}.{#sys_language_uid} IN (-1, 0)'
                    . ' AND NOT {#tx_chfbase_domain_model_agent}.{#type}=\'contributor\'',
                'treeConfig' => [
                    'parentField' => 'parent_agent',
                    'appearance' => [
                        'showHeader' => true,
                        'expandAll' => true,
                    ],
                ],
                'size' => 8,
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
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_tag}.{#sys_language_uid} IN (-1, 0)'
                    . ' AND {#tx_chfbase_domain_model_tag}.{#pid} IN (###CURRENT_PID###, ###SITE:settings.chf.data.page###)'
                    . ' AND {#tx_chfbase_domain_model_tag}.{#type}=\'licenceTag\'',
                'MM' => 'tx_chfbase_domain_model_tag_record_mm',
                'MM_match_fields' => [
                    'fieldname' => 'licence',
                    'tablenames' => 'tx_chfbase_domain_model_relation',
                ],
                'MM_opposite_field' => 'items',
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
                'items' => [
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.author',
                        'value' => 'author',
                        'group' => 'authorshipRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.photographer',
                        'value' => 'photographer',
                        'group' => 'authorshipRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.editor',
                        'value' => 'editor',
                        'group' => 'authorshipRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.translator',
                        'value' => 'translator',
                        'group' => 'authorshipRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.contributor',
                        'value' => 'contributor',
                        'group' => 'authorshipRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.publisher',
                        'value' => 'publisher',
                        'group' => 'authorshipRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.rightsOwner',
                        'value' => 'rightsOwner',
                        'group' => 'authorshipRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.genericLocation',
                        'value' => 'genericLocation',
                        'group' => 'locationRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.originLocation',
                        'value' => 'originLocation',
                        'group' => 'locationRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.formerLocation',
                        'value' => 'formerLocation',
                        'group' => 'locationRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.birthPlace',
                        'value' => 'birthPlace',
                        'group' => 'locationRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.workPlace',
                        'value' => 'workPlace',
                        'group' => 'locationRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.deathPlace',
                        'value' => 'deathPlace',
                        'group' => 'locationRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.agency',
                        'value' => 'agency',
                        'group' => 'agentRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.relationship',
                        'value' => 'relationship',
                        'group' => 'agentRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.depiction',
                        'value' => 'depiction',
                        'group' => 'agentRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.representation',
                        'value' => 'representation',
                        'group' => 'agentRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.designer',
                        'value' => 'designer',
                        'group' => 'agentRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.artist',
                        'value' => 'artist',
                        'group' => 'agentRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.workshop',
                        'value' => 'workshop',
                        'group' => 'agentRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.manufacturer',
                        'value' => 'manufacturer',
                        'group' => 'agentRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.benefactor',
                        'value' => 'benefactor',
                        'group' => 'agentRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.collector',
                        'value' => 'collector',
                        'group' => 'agentRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.curator',
                        'value' => 'curator',
                        'group' => 'agentRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.restorer',
                        'value' => 'restorer',
                        'group' => 'agentRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.allContent',
                        'value' => 'allContent',
                        'group' => 'licenceRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.metadata',
                        'value' => 'metadata',
                        'group' => 'licenceRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.text',
                        'value' => 'text',
                        'group' => 'licenceRelation',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.role.media',
                        'value' => 'media',
                        'group' => 'licenceRelation',
                    ],
                ],
                'itemGroups' => [
                    'authorshipRelation' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.type.authorshipRelation',
                    'locationRelation' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.type.locationRelation',
                    'agentRelation' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.type.agentRelation',
                    'licenceRelation' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractRelation.type.licenceRelation',
                ],
                'default' => 'author',
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
        'link_text' => [
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
            ],
        ],
        'last_checked' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.linkRelation.lastChecked',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.linkRelation.lastChecked.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
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
        'parent_resource' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.parentResource',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.parentResource.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingleBox',
                'foreign_table' => 'tx_chfbase_domain_model_resource',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_resource}.{#sys_language_uid} IN (-1, 0)',
                'MM' => 'tx_chfbase_domain_model_resource_record_mm',
                'MM_match_fields' => [
                    'fieldname' => 'parent_resource',
                    'tablenames' => 'tx_chfbase_domain_model_relation',
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
                'default' => 'r',
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
    ],
    'palettes' => [
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
            'showitem' => 'url,--linebreak--,link_text,last_checked,',
        ],
        'iriUuid' => [
            'showitem' => 'iri,uuid,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'type,description,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,parent_resource,--palette--;;iriUuid,',
        ],
        'authorshipRelation' => [
            'showitem' => 'type,record,--palette--;;contributorRole,description,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,parent_resource,--palette--;;iriUuid,',
        ],
        'locationRelation' => [
            'showitem' => 'type,record,--palette--;;locationRole,description,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,parent_resource,--palette--;;iriUuid,',
        ],
        'agentRelation' => [
            'showitem' => 'type,record,--palette--;;agentRole,description,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,parent_resource,--palette--;;iriUuid,',
        ],
        'licenceRelation' => [
            'showitem' => 'type,record,--palette--;;licenceRole,description,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,parent_resource,--palette--;;iriUuid,',
        ],
        'linkRelation' => [
            'showitem' => 'type,record,--palette--;;urlLinkTextLastChecked,description,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,parent_resource,--palette--;;iriUuid,',
        ],
    ],
];
