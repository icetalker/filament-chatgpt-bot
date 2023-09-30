<?php

namespace Icetalker\FilamentChatgptBot\Components;

use Icetalker\FilamentChatgptBot\OpenAI;
use Livewire\Component;

class ChatgptBot extends Component
{

    public array $messages;

    public string $question;

    public string $winWidth;

    public string $winPosition;

    public bool $showPositionBtn;

    public bool $panelHidden;

    protected $listeners = [
        //shortcut
        'ctrl+s' => 'sendMessage',
        'ctrl+r' => 'changeWinWidth',
        'ctrl+p' => 'changeWinPosition',
        'ctrl+d' => 'resetSession',
    ];

    public function mount(): void
    {
        $this->panelHidden = true;
        $this->winWidth = "width:350px;";
        $this->winPosition = "";
        $this->showPositionBtn = true;
        $this->messages = session('messages', []);
        $this->question = "";
    }

    public function render()
    {
        return view('filament-chatgpt-bot::livewire.chat-bot');
    }

    public function sendMessage(): void
    {
        if(empty(trim($this->question))){
            $this->question = "";
            return;
        }
        $this->messages[] = [
            "role" => 'user',
            "content" => $this->question,
        ];

        $this->dispatch('sendmessage', ['message' => $this->question]);
        $this->question = "";
        $this->chat();
    }

    public function changeWinWidth(): void
    {
        if($this->winWidth=="width:350px;"){
            $this->winWidth = "width:100%;";
            $this->showPositionBtn = false;
        }else{
            $this->winWidth = "width:350px;";
            $this->showPositionBtn = true;
        }
    }

    public function changeWinPosition(): void
    {
        if($this->winPosition != "left"){
            $this->winPosition = "left";
        }else{
            $this->winPosition = "";
        }
    }

    public function resetSession(): void
    {
        request()->session()->forget('messages');
        $this->messages = [];
    }

    protected function chat(): void
    {

        $client = OpenAI::client();

        $response = $client->chat([
            'model' => 'gpt-3.5-turbo',
            'messages' => $this->messages
        ]);
        if($response){
            $response = json_decode($response);
        }

        if (@$response->error) {
            $this->messages[] = ['role' => 'assistant', 'content' => $response->error->message];
        } else {
            $this->messages[] = ['role' => 'assistant', 'content' => @$response->choices[0]->message->content];
        }

        request()->session()->put('messages', $this->messages);

    }
}
