<?php namespace Gnanakeethan\Edor;

use Illuminate\Support\ServiceProvider;

class EdorServiceProvider extends ServiceProvider {

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
        //Telling that this is a package from a repository
        $this->package('gnanakeethan/edor');


        //Identifying Path to the File
        $path = realpath(__DIR__.'/../../');

        //Including the Start File into the System.
        include "{$path}/start.php";
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

}