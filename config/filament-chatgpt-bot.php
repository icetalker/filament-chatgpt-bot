<?php

// config for Icetalker/FilamentChatgptBot
return [
    'enable' => true,

    'botname' => env('ICETALKER_BOTNAME'),

    'openai' => [
        'api_key' => env('OPENAI_API_KEY'),
        'organization' => env('OPENAI_ORGANIZATION'),
    ],
    
    'proxy'=> env('OPENAI_PROXY'),

];