<div class="chatbot-box">
    <!-- component -->
    <div class="chatbot-chat-btn-wrapper">
        <div class="chatbot-chat-btn" style="background-color: {{ $panelHidden ? '#888' : 'rgb(16, 163, 127)' }};" wire:click="$toggle('panelHidden')" id="btn-chat">
            <x-filament-chatgpt-bot::chatgpt-svg />
        </div>
    </div>
    <div class="chatbot-window {{ $winPosition=="left"?"left-0":"right-0" }} {{ $panelHidden ? 'hidden' : '' }}" style="{{ $panelHidden?'display:none;':'' }}{{ $winWidth }}" id="chat-window">
        <div class="chatbot-window-header">
            <div class="chatbot-user">
                <div class="relative">
                    <span class="absolute text-green-500 right-0 bottom-0">
                        <svg width="20" height="20">
                        <circle cx="8" cy="8" r="8" fill="currentColor"></circle>
                        </svg>
                    </span>
                    <div class="chatbot-user-avatar" style="background-color: rgb(16, 163, 127); ">
                        <x-filament-chatgpt-bot::chatgpt-svg />
                    </div>
                </div>
                <div class="chatbot-user-name flex flex-col leading-tight">
                    <div class="text-xl mt-1 flex items-center">
                        <span class="text-gray-700 mr-2">{{ $name }}</span>
                    </div>
                    <span class="text-lg text-gray-600"></span>
                </div>
            </div>
            <div class="chatbot-window-actions">
                <button type="button" class="chatbot-window-action-button" wire:click="resetSession()" title="clear text [CTRL+D]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                      </svg>
                </button>
                <button type="button" class="chatbot-window-action-button" wire:click="changeWinWidth()" title="resize [CTRL+R]" style="margin-left:0.25rem;">
                    @if($winWidth!="width:100%;")
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                    </svg>
                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 9V4.5M9 9H4.5M9 9L3.75 3.75M9 15v4.5M9 15H4.5M9 15l-5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5l5.25 5.25" />
                    </svg>
                    @endif
                </button>
                <button type="button" class="chatbot-window-action-button {{ $showPositionBtn?'':'hidden' }}" wire:click="changeWinPosition()" title="{{ $winPosition=='left' ? 'go right' : 'go left' }} [CTRL+P]" style="margin-left:0.25rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                    </svg>
                </button>
                <button type="button" class="chatbot-window-action-button" wire:click="$toggle('panelHidden')" title="Hide panel" style="margin-left:0.25rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                      </svg>
                </button>
            </div>
        </div>
        <div id="messages" class="chatbot-content-box scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
            @foreach($messages as $message)
                @if($message['role'] !== 'system')
                @if($message['role'] == "assistant")
                    <div class="chat-bubble">
                        <div class="bubble-left">
                            <div class="message-content-container">
                                <div><div class="message-content rounded-bl-none">@isset($message['content']){!! \Illuminate\Mail\Markdown::parse($message['content']) !!}@endisset</div></div>
                            </div>
                            <div class="message-sender" style="background-color: rgb(16, 163, 127);">
                                <x-filament-chatgpt-bot::chatgpt-svg />
                            </div>
                        </div>
                    </div>
                @else
                    <div class="chat-bubble">
                        <div class="bubble-right">
                            <div class="message-content-container">
                                <div><div class="message-content rounded-br-none">{!! \Illuminate\Mail\Markdown::parse($message['content']) !!}</div></div>
                            </div>
                            @php
                                $name = auth()->user()? substr(auth()->user()->name,0,1):"匿";
                                $avatar = "https://ui-avatars.com/api/?name={$name}&color=FFFFFF&background=111827'";
                            @endphp
                            <img src="{{ $avatar }}" alt="My profile" class="sender-avatar">
                        </div>
                    </div>
                @endif
                @endif
            @endforeach
        </div>
        <div class="chatbot-input-box">
            <div class="sending-tip" style="color:rgb(35, 190, 100)" wire:loading wire:target="sendMessage">Message Sending...</div>
            <div class="chatbot-input-wrapper">
                <textarea wire:model.defer="question" tabindex="0" data-id="root" style="max-height: 200px; height: 24px; " placeholder="Send a message..." id="chat-input"></textarea>
                <button wire:click="sendMessage" wire:loading.attr="disabled" class="message-button" title="press CTRL+S to send"><svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-1" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg></button>
            </div>
        </div>
    </div>

    <style>
        .scrollbar-w-2::-webkit-scrollbar {
            width: 0.5rem;
            height: 0.5rem;
        }

        .scrollbar-track-blue-lighter::-webkit-scrollbar-track {
            --bg-opacity: 1;
            background-color: #f7fafc;
            background-color: rgba(247, 250, 252, var(--bg-opacity));
        }

        .scrollbar-thumb-blue::-webkit-scrollbar-thumb {
            --bg-opacity: 1;
            background-color: #edf2f7;
            background-color: rgba(237, 242, 247, var(--bg-opacity));
        }

        .scrollbar-thumb-rounded::-webkit-scrollbar-thumb {
            border-radius: 0.25rem;
        }

       
    </style>

    <script>
        const el = document.getElementById('messages')
        window.onload = function(){
            el.scrollTop = el.scrollHeight
        }

        var textarea = document.querySelector('#chat-input');

        textarea.addEventListener("input", function(e) {
            this.style.height = "inherit";
            this.style.height = `${this.scrollHeight}px`;
        });

        window.addEventListener('sendmessage', event => {
            el.scrollTop = el.scrollHeight
        })

        window.onkeydown = function(){
            //shorcut
            // if(event.ctrlKey && event.keyCode===71){
            //     //CTRL+G
            //     event.preventDefault();
            //     Livewire.emit("ctrl+g");
            //     return
            // }
            if(event.ctrlKey && event.altKey && event.keyCode===90){
                event.preventDefault();
                Livewire.emit("ctrl+alt+z");
                return
            }
            if(event.ctrlKey && event.keyCode===83){
                event.preventDefault();
                Livewire.emit("ctrl+s");
                return
            }
            if(event.ctrlKey && event.keyCode===82){
                event.preventDefault();
                Livewire.emit("ctrl+r");
                return
            }
            if(event.ctrlKey && event.keyCode===80){
                event.preventDefault();
                Livewire.emit("ctrl+p");
                return
            }
            if(event.ctrlKey && event.keyCode===68){
                event.preventDefault();
                Livewire.emit("ctrl+d");
                return
            }

        }
    </script>

</div>
