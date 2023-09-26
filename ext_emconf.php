<?php

$EM_CONF[$_EXTKEY] = [
    'title'          => 'CHF Base',
    'description'    => 'Common classes as well as a UI library and other base services for the CHF',
    'category'       => 'misc',
    'author'         => 'Jonatan Jalle Steller',
    'author_email'   => 'jonatan.steller@adwmainz.de',
    'author_company' => 'Academy of Sciences and Literature Mainz',
    'state'          => 'beta',
    'version'        => '0.1.0',
    'constraints'    => [
        'depends'   => [
            'typo3' => '12.0.0-12.4.99',
            'php'   => '8.1.0-8.2.99'
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

?>