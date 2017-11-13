<?php

return
    $GLOBALS['routes']['admin'] = [
        'addnews' => 'addnews',
        '[a-z,0-9,-,_,/]' => 'view',
        '[^a-z,0-9,-,_,/]' => 'index'

    ];