<?php

// config for Icetalker/FilamentChatgptBot
return [
    'enable' => env('CHATBOT_ENABLE', true),

    'botname' => env('ICETALKER_BOTNAME', 'CHATGPT'),

    'openai' => [
        'api_key' => env('OPENAI_API_KEY'),
        'organization' => env('OPENAI_ORGANIZATION'),
    ],
    
    'proxy'=> env('OPENAI_PROXY'),

];