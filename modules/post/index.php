<?php

return
    $GLOBALS['routes']['market'] = [
        'addpost' => 'addpost',
        '[a-z,0-9,-,_,/]' => 'view',
        '[^a-z,0-9,-,_,/]' => 'index'

    ];