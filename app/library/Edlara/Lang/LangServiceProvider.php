<?php namespace Edlara\Lang;

use Illuminate\Translation\TranslationServiceProvider as ServiceProvider;

class LangServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->registerLoader();
        $this->app->bindShared('translator', function ($app) {
            $loader = $app['translation.loader'];

            // When registering the translator component, we'll need to set the default
            // locale as well as the fallback locale. So, we'll grab the application
            // configuration so we can easily get both of these values from there.
            $locale = $app['config']['app.locale'];

            $trans = new Lang($loader, $locale);

            return $trans;
            // return new Lang()FileLoader($app['files'], $app['path'].'/lang');
        });
    }
}
