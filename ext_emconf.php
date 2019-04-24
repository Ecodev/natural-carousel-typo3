<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Natural Carousel',
    'description' => 'Carousel gallery with few dependency and mobile support',
    'category' => 'plugin',
    'author' => 'Fabien Udriot, Samuel Baptista',
    'author_email' => 'fabien.udriot@ecodev.ch, samuel.baptista@ecodev.ch',
    'author_company' => 'Ecodev',
    'state' => 'beta',
    'version' => '1.0.9',
    'constraints' =>
        [
            'depends' =>
                [
                    'typo3' => '7.6.0-9.5.99',
                    'vidi' => '0.0.0-0.0.0',
                ],
            'conflicts' =>
                [
                ],
            'suggests' =>
                [
                ],
        ],
];
