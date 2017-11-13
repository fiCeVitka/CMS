<?php

return
    $GLOBALS['routes']['news'] = [
        'addnews' => 'addnews',
        '[a-z,0-9,-,_,/]' => 'view',
        '[^a-z,0-9,-,_,/]' => 'index'

    ];