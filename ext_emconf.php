<?php

$EM_CONF[$_EXTKEY] = [
    'title'          => 'CHF Base',
    'description'    => 'Common classes as well as a UI library and other base services for the CHF',
    'category'       => 'misc',
    'author'         => 'Jonatan Jalle Steller',
    'author_email'   => 'jonatan.steller@adwmainz.de',
    'author_company' => 'Academy of Sciences and Literature Mainz',
    'state'          => 'stable',
    'version'        => '0.6.0',
    'constraints'    => [
        'depends'   => [
            'typo3'                => '13.0.0-13.99.99',
            'fluid_styled_content' => '13.0.0-13.99.99',
            'rte_ckeditor'         => '13.0.0-13.99.99'
        ],
        'conflicts' => [
        ],
        'suggests'  => [
        ],
    ],
    'autoload'       => [
        'psr-4' => [
           'Digicademy\\CHFBase\\' => 'Classes/'
        ]
     ]
];
