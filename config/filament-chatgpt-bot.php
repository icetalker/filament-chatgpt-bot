<?php

// config for Icetalker/FilamentChatgptBot
return [
    'enable' => false,

    'botname' => env('ICETALKER_BOTNAME'),

    'openai' => [
        'api_key' => env('OPENAI_API_KEY'),
        'organization' => env('OPENAI_ORGANIZATION'),
    ],
    
    'proxy'=> env('OPENAI_PROXY'),

];