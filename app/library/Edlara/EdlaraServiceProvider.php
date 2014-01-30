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
        include_once(__DIR__.'/routes.php');
        include_once(__DIR__.'/filters.php');
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
        \App::bind('opengraph',function(){
            return \Edlara\Html\OpenGraph::getInstance();
        });
        \App::bindShared('translator.edlara',function(){
            return new \Edlara\Lang\Lang();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('meta','opengraph','translator.edlara');
    }

}