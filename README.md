# ChatGPT Intergration 

Filament ChatGPT Bot is a filament plugin that allow you to use ChatGPT out of the box within Filament Application. 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/icetalker/filament-chatgpt-bot.svg?style=flat-square)](https://packagist.org/packages/icetalker/filament-chatgpt-bot)
[![Total Downloads](https://img.shields.io/packagist/dt/icetalker/filament-chatgpt-bot.svg?style=flat-square)](https://packagist.org/packages/icetalker/filament-chatgpt-bot)

Preview:
![](https://raw.githubusercontent.com/icetalker/filament-chatgpt-bot/main/screenshot/dark-mode.png)
Full Screen:
![](https://raw.githubusercontent.com/icetalker/filament-chatgpt-bot/main/screenshot/full-screen.png)
Light Mode:
![](https://raw.githubusercontent.com/icetalker/filament-chatgpt-bot/main/screenshot/light-mode.png)

## Features

- Integrate with ChatGPT
- Easy to Setup
- Shortcut allows control of panel in more convenient way
- Support for dark mode

## Installation

First, you can install the package via composer:

```bash
composer require icetalker/filament-chatgpt-bot
```

For Filament V2, Please lock the the version to v0.1.*:

```bash
composer require icetaker/filament-chatgpt-bot:"v0.1.3"
```

## Publish

### Publish Config File

Next, you can publish the config files with:

```bash
php artisan vendor:publish --tag="filament-chatgpt-bot-config"
```

This will create a configuration file locate in `config/filament-chatgpt-bot.php`, and you can set up the Chatbot by setting envirnoment in `.env`:

```txt
CHATBOT_ENABLE = true #default to be true, no need to set unless you would like to disable it.

OPENAI_API_KEY=sk-...
```

Go to admin panel, you will see a small icon in gray color on the bottom-right corner of every page. Click the icon, you will then see a chat panel. And now you can talk to OpenAI ChatGPT with the chat panel. 

By optionally adding the `OPENAI_PROXY` to `.env` file, you could use http proxy to connect ChatGPT. Example as below:

```
OPENAI_PROXY=127.0.0.1:8080
```
> For more options, please check in `config/filament-chatgpt-bot.php`;

### Publish CSS File

Filament will pulish and link to the css file automatically. For regular Laravel project, you could publish it using:

```bash
php artisan vendor:publish --tag="filament-chatgpt-bot-css"
```

### View

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-chatgpt-bot-views"
```

## More

1. By defult, there is a small chatgpt icon on bottom-right corner of admin panel after the package installed. You could disable it by setting `enable` to `false` in `config/filament-chatgpt-bot.php` files:

```php
    'enable' => false,
```

or in `.env`:

```
CHATBOT_ENABLE = false;
```

> This may require you publish [config files](#publish-config-file).

2. You could also render it in [Panel Configuration](https://laravel-filament.cn/docs/zh-CN/5.x/advanced/render-hooks) like this：

```php
public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->renderHook(
            'panels::body.end',
            fn (): string => auth()->check() ? Blade::render('@livewire(\'livewire-ui-modal\')') : '',
        );
}
```

> Set `enable=true` in `config/filament-chatgpt-bot.php` files, if you like to render it in [Admin Panel](https://laravel-filament.cn/docs/zh-CN/5.x/advanced/render-hooks).

3. Alternatively, you can add it to any blade file within livewire page if you like to do it manually;

```blade
<body>
    ...

    @livewire('filament-chatgpt-bot')
</body>
```

> This is work for all livewire page in any Laravel Project, not just Filament. Please also make sure [CSS File are pulished](#publish-css-file) properly, and then import the css file and Livewire compoent while use in other Laravel Project. 

```
<link rel="stylesheet" href="{{ asset('css/filament-chatgpt-bot/chatbot.css') }}">
```

```
@livewire('filament-chatgpt-bot')
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Martin Hwang](https://github.com/icetalker)
- [All Contributors](../../contributors)

## Support

Any Problem please email: martin.hwang@outlook.com.
