<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Natural Carousel',
    'description' => 'Carousel gallery with few dependency and mobile support',
    'category' => 'plugin',
    'author' => 'Fabien Udriot, Samuel Baptista',
    'author_email' => 'fabien.udriot@ecodev.ch, samuel.baptista@ecodev.ch',
    'author_company' => 'Ecodev',
    'state' => 'stable',
    'version' => '2.2.0',
    'constraints' =>
        [
            'depends' =>
                [
                    'typo3' => '10.0.0-10.4.99',
                    'vidi' => '5.0.0-0.0.0',
                ],
            'conflicts' =>
                [
                ],
            'suggests' =>
                [
                ],
        ],
];
