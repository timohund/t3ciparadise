<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'T3ciparadise - how to test extensions in TPYO3',
    'description' => 'Example extension',
    'version' => '1.0.0-dev',
    'state' => 'stable',
    'category' => 'plugin',
    'author' => 'Timo Hund',
    'author_email' => 'timo.hund@dkd.de',
    'author_company' => 'dkd Internet Service GmbH',
    'module' => '',
    'uploadfolder' => 0,
    'createDirs' => '',
    'modify_tables' => '',
    'clearCacheOnLoad' => 0,
    'constraints' => [
        'depends' => [
            'typo3' => '7.6.0-8.99.99'
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'autoload' => [
        'psr-4' => [
            'Dkd\\T3ciparadise\\' => 'Classes/',
            'Dkd\\T3ciparadise\\Tests\\' => 'Tests/'
        ]
    ]
];
