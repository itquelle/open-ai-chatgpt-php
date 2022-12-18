<?php
/**
 * @author itQuelle.de
 */

namespace OpenAiApi;

use Illuminate\Support\ServiceProvider;

/**
 * Class ApiServiceProvider
 */
class ApiServiceProvider extends ServiceProvider{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(){
        $this->app->singleton('openAIApi', Api::class);
    }

}