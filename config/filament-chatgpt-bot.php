<?php

// config for Icetalker/FilamentChatgptBot
return [
    'enable' => env('CHATBOT_ENABLE', true),

    'botname' => env('ICETALKER_BOTNAME', 'CHATGPT'),

    'openai' => [
        'api_key' => env('OPENAI_API_KEY'),
        'organization' => env('OPENAI_ORGANIZATION'),

        'model' => env('OPENAI_MODEL', 'gpt-5.6-sol')
    ],
    
    'proxy'=> env('OPENAI_PROXY'),

];