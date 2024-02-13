<?php


namespace Module\Product\Provider;


use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom([
            base_path() . DIRECTORY_SEPARATOR . 'module' . DIRECTORY_SEPARATOR . 'Product' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'migrations',
        ]);

        $this->loadMigrationsFrom([
            base_path() . DIRECTORY_SEPARATOR . 'module' . DIRECTORY_SEPARATOR . 'Product' . DIRECTORY_SEPARATOR . 'migrations',
        ]);
    }

}
