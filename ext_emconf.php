<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Natural Carousel',
    'description' => 'Carousel gallery with few dependency and mobile support',
    'category' => 'plugin',
    'author' => 'Fabien Udriot, Samuel Baptista',
    'author_email' => 'fabien.udriot@ecodev.ch, samuel.baptista@ecodev.ch',
    'author_company' => 'Ecodev',
    'state' => 'stable',
    'version' => '2.1.0-dev',
    'constraints' =>
        [
            'depends' =>
                [
                    'typo3' => '9.5.0-10.4.99',
                    'vidi' => '3.0.0-0.0.0',
                ],
            'conflicts' =>
                [
                ],
            'suggests' =>
                [
                ],
        ],
];
