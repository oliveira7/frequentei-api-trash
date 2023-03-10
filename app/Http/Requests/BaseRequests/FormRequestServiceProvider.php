<?php

namespace App\Http\Requests\BaseRequests;

use Exception;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class FormRequestServiceProvider extends ServiceProvider
{
    /**
     * On service boot, we say what should be done when resolving and afterResolving FormRequest class.
     */
    public function boot(): void
    {
        $this->app->resolving(FormRequest::class, function ($form, $app): void {
            $form = FormRequest::createFrom($app['request'], $form);
            $form->setContainer($app);
        });

        $this->app->afterResolving(FormRequest::class, function (FormRequest $form): void {
            $form->validate();
        });
    }

    /**
     * Binds method of RequestInterface to it's appropriate concrete class.
     */
    public function register(): void
    {

        $this->app->bind(RequestInterface::class, function ($app) {
            if (!$app->request->isMethod('post') && !$app->request->isMethod('put')) {
                return new DefaultRequest();
            }

            try {
                $class = $this->defineClassToBind($app);
                $instance = new $class();
            } catch (\Throwable $e) {
                $instance = new DefaultRequest();
            }

            return $instance;
        });
    }

    /**
     * Get the appropriate full name of class that should be bound.
     */
    private function defineClassToBind($app): string
    {
        [$controller, $action] = explode('@', $app->request->route()->action['uses']);

        $controllerShortName = class_basename($controller);
        $controllerFolderName = str_replace('Controller', '', $controllerShortName);

        $fileName = Str::ucfirst(Str::camel($action)) . 'Request';
        $fullClassName = "App\\Http\\Requests\\{$controllerFolderName}\\{$fileName}";

        if (!class_exists($fullClassName)) {
            throw new Exception("The Request file {$fullClassName} does not exists.");
        }

        return $fullClassName;
    }
}
