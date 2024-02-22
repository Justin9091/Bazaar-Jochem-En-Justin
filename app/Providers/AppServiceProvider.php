<?php

namespace App\Providers;

use App\Models\Property;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // Get all Properties from the database and add it to the view

        View::composer('*', function ($view) {
            foreach (Property::all() as $property) {
                $key = $property["key"];

                if (strpos($key, '-') !== false) {
                    $key = str_replace('-', '_', $key);
                }

                $view->with($key, $property["value"]);
            }

            $view->with("primary_text", $this->compileClassName(["primary-text"]));
            $view->with("secondary_text", $this->compileClassName(["secondary-text"]));
            $view->with("button", $this->compileClassName(["bg", "padding", "border-radius", "shadow", "margin"]));
            $view->with("card", $this->compileClassName(["bg", "padding", "border-radius", "shadow", "margin"]));
        });
    }

    // Facking lelijk, moet ik nog aanpassen maar het werkt dus fix ik later
    private function compileClassName($propNames)
    {
        $className = "";
        foreach ($propNames as $propName) {
            if ($propName == "bg") {
                $primColorProperty = Property::where('key', 'primary-color')->first();
                $primOpacityProperty = Property::where('key', 'primary-opacity')->first();

                $property = "bg-" . $primColorProperty['value'] . "-" . $primOpacityProperty["value"];
            } else if ($propName == "primary-text") {
                $primColorProperty = Property::where('key', 'text-color')->first();
                $primOpacityProperty = Property::where('key', 'text-opacity')->first();

                $property = "text-" . $primColorProperty['value'] . "-" . $primOpacityProperty["value"];
            } else if($propName == "secondary-text") {
                $secColorProperty = Property::where('key', 'secondary-text-color')->first();
                $secOpacityProperty = Property::where('key', 'secondary-text-opacity')->first();

                $property = "text-" . $secColorProperty['value'] . "-" . $secOpacityProperty["value"];
            } else {
                $result = Property::where('key', $propName)->first();

                if (!isset($result)) {
                    continue;
                }

                $property = $result['value'];
            }
            $className .= $property . " ";
        }
        return $className;
    }
}
