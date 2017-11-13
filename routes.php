<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 22.03.17
 * Time: 1:34
 */

return array(
    'news' => [
        'addnews' => 'addnews',
        '[a-z,0-9,-,_,/]' => 'view',
        '[^a-z,0-9,-,_,/]' => 'index',

    ],
    'main' => [
        '[^a-z,0-9,-,_,/]' => 'index'
    ],
    'register' => [
        '[^a-z,0-9,-,_,/]' => 'index'
    ],
    'admin' => [
        '[^a-z,0-9,-,_,/]' => 'index'
    ]

);

