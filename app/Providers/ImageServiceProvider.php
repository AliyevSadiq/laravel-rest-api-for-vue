<?php

namespace App\Providers;

use App\Contract\Image\ImageManipulatorInterface;
use App\Service\Image\ImageManipulator;
use Illuminate\Support\ServiceProvider;


class ImageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ImageManipulatorInterface::class, ImageManipulator::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
