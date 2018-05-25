<?php
namespace Orchids\FieldEx\Providers;

use Illuminate\Support\ServiceProvider;

use Orchid\Platform\Dashboard;

class FieldExServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     * After change run:  php artisan vendor:publish --provider="Orchids\FieldEx\Providers\MonacoEditorServiceProvider"
     * If need rewrite js files:  php artisan vendor:publish --force --provider="Orchids\FieldEx\Providers\MonacoEditorServiceProvider"
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'orchids/fieldex');
        /*
        $this->publishes([		
				__DIR__.'/../../public/js/' => public_path('orchids/fieldex/js'),
				__DIR__.'/../../public/mix-manifest.json' => public_path('orchids/fieldex/mix-manifest.json'),
			], 'public'); 
        
        $dashboard = $this->app->make(Dashboard::class);    
        */
        //$dashboard->registerResource('stylesheets','custom.css');
        //$dashboard->registerResource('scripts','/orchids/fieldex/js/fieldex.js');    
    }
}