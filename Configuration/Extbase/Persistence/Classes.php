<?php

declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


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
    Digicademy\CHFBase\Domain\Model\ContentElemet::class => [
        'tableName' => 'tt_content',
    ],
    Digicademy\CHFBase\Domain\Model\AbstractTag::class => [
        'tableName' => 'tx_chfbase_domain_model_tag',
        'recordType' => 'abstractTag',
        'subclasses' => [
            'labelTag'     => Digicademy\CHFBase\Domain\Model\LabelTag::class,
            'labelTypeTag' => Digicademy\CHFBase\Domain\Model\LabelTypeTag::class,
            'licenceTag'   => Digicademy\CHFBase\Domain\Model\LicenceTag::class,
        ]
    ],
];

?>