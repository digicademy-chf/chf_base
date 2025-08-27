<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * Rules to map object inheritance to TCA tables
 * 
 * List of inherited object models and how they relate to TCA tables and
 * values of the property specified as 'type' in the TCA config. Simpler
 * objects based on tables of the same name and without multiple types
 * do not need to be listed here since Extbase maps them automatically.
 * For more information on the persistence of Extbase models see
 * https://docs.typo3.org/m/typo3/reference-coreapi/main/en-us/ExtensionArchitecture/Extbase/Reference/Domain/Persistence.html.
 */
return [
    Digicademy\CHFBase\Domain\Model\AbstractResource::class => [
        'tableName' => 'tx_chfbase_domain_model_resource',
        'recordType' => '0',
        'subclasses' => [
            'genericResource' => Digicademy\CHFBase\Domain\Model\GenericResource::class,
        ],
    ],
    Digicademy\CHFBase\Domain\Model\GenericResource::class => [
        'tableName' => 'tx_chfbase_domain_model_resource',
        'recordType' => 'genericResource',
    ],
    Digicademy\CHFBase\Domain\Model\AbstractTag::class => [
        'tableName' => 'tx_chfbase_domain_model_tag',
        'recordType' => '0',
        'subclasses' => [
            'labelTag' => Digicademy\CHFBase\Domain\Model\LabelTag::class,
            'labelTypeTag' => Digicademy\CHFBase\Domain\Model\LabelTypeTag::class,
            'licenceTag' => Digicademy\CHFBase\Domain\Model\LicenceTag::class,
        ],
    ],
    Digicademy\CHFBase\Domain\Model\LabelTag::class => [
        'tableName' => 'tx_chfbase_domain_model_tag',
        'recordType' => 'labelTag',
    ],
    Digicademy\CHFBase\Domain\Model\LabelTypeTag::class => [
        'tableName' => 'tx_chfbase_domain_model_tag',
        'recordType' => 'labelTypeTag',
    ],
    Digicademy\CHFBase\Domain\Model\LicenceTag::class => [
        'tableName' => 'tx_chfbase_domain_model_tag',
        'recordType' => 'licenceTag',
    ],
    Digicademy\CHFBase\Domain\Model\AbstractRelation::class => [
        'tableName' => 'tx_chfbase_domain_model_relation',
        'recordType' => '0',
        'subclasses' => [
            'authorshipRelation' => Digicademy\CHFBase\Domain\Model\AuthorshipRelation::class,
            'locationRelation' => Digicademy\CHFBase\Domain\Model\LocationRelation::class,
            'agentRelation' => Digicademy\CHFBase\Domain\Model\AgentRelation::class,
            'licenceRelation' => Digicademy\CHFBase\Domain\Model\LicenceRelation::class,
            'linkRelation' => Digicademy\CHFBase\Domain\Model\LinkRelation::class,
        ],
    ],
    Digicademy\CHFBase\Domain\Model\AuthorshipRelation::class => [
        'tableName' => 'tx_chfbase_domain_model_relation',
        'recordType' => 'authorshipRelation',
    ],
    Digicademy\CHFBase\Domain\Model\LocationRelation::class => [
        'tableName' => 'tx_chfbase_domain_model_relation',
        'recordType' => 'locationRelation',
    ],
    Digicademy\CHFBase\Domain\Model\AgentRelation::class => [
        'tableName' => 'tx_chfbase_domain_model_relation',
        'recordType' => 'agentRelation',
    ],
    Digicademy\CHFBase\Domain\Model\LicenceRelation::class => [
        'tableName' => 'tx_chfbase_domain_model_relation',
        'recordType' => 'licenceRelation',
    ],
    Digicademy\CHFBase\Domain\Model\LinkRelation::class => [
        'tableName' => 'tx_chfbase_domain_model_relation',
        'recordType' => 'linkRelation',
    ],
    Digicademy\CHFBase\Domain\Model\ContentElement::class => [
        'tableName' => 'tt_content',
    ],
];
