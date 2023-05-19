<?php

namespace Icetalker\FilamentChatgptBot;

use Exception;

final class OpenAI{

    /**
     * @throws Exception
     */
    public static function client()
    {
        $openai_key = config('filament-chatgpt-bot.openai.api_key');
        if(!$openai_key){
            return throw new Exception("API_KEY Missing!");
        }
        $proxy = config('filament-chatgpt-bot.proxy');

        $openai = new \Orhanerday\OpenAi\OpenAi($openai_key);
        if($proxy){
            $openai->setProxy($proxy);
        }

        return $openai;

    }

}
