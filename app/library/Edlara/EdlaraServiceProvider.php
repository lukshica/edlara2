<?php namespace Edlara;

use Illuminate\Support\ServiceProvider;

class EdlaraServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
        \App::bind('meta',function(){
            return new \Edlara\Html\Meta(new \Illuminate\Html\HtmlBuilder);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('meta');
    }

}