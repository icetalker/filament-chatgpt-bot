<?php

namespace Icetalker\FilamentChatgptBot;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Filament\Support\Facades\FilamentView;
use Illuminate\Support\Facades\Blade;
use Icetalker\FilamentChatgptBot\Components\ChatgptBot;
use Livewire\Livewire;

class FilamentChatgptBotServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-chatgpt-bot')
            ->hasConfigFile()
            ->hasViews();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->bootLoaders();
        $this->bootPublishing();

        Livewire::component('filament-chatgpt-bot', ChatgptBot::class);

        if(config('filament-chatgpt-bot.enable')){
            FilamentView::registerRenderHook(
                'panels::body.end',
                fn (): string => auth()->check() ? Blade::render('@livewire(\'filament-chatgpt-bot\')'):'',
            );
        }

    }

    protected function bootLoaders()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'filament-chatgpt-bot');
    }

    protected function bootPublishing()
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/filament-chatgpt-bot'),
        ], 'filament-chatgpt-bot-views');

        $this->publishes([
            __DIR__.'/../config/filament-chatgpt-bot.php' => config_path('filament-chatgpt-bot.php'),
        ], 'filament-chatgpt-bot-config');
    }

}
