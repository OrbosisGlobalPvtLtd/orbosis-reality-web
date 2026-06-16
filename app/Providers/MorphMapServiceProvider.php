<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class MorphMapServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void{}

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $translation = include(lang_path('translationModels.php'));
        if(!empty($translation)){
            Relation::morphMap($translation);
        }
        
    }
}
