<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Providers\AppServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertiesController extends Controller
{
    public function index() {

        $colors = array(
            "slate",
            "gray",
            "zinc",
            "neutral",
            "stone",
            "red",
            "orange",
            "amber",
            "yellow",
            "lime",
            "green",
            "emerald",
            "teal",
            "cyan",
            "sky",
            "blue",
            "indigo",
            "violet",
            "purple",
            "fuchsia",
            "pink",
            "rose"
        );

        $opacities = array(
            "50",
            "100",
            "200",
            "300",
            "400",
            "500",
            "600",
            "700",
            "800",
            "900",
            "950"
        );

        $shadows = [
            'none' => 'shadow-none',
            'sm' => 'shadow-sm',
            'default' => 'shadow',
            'md' => 'shadow-md',
            'lg' => 'shadow-lg',
            'xl' => 'shadow-xl',
            '2xl' => 'shadow-2xl'
        ];

        $rounded = [
            'none' => 'rounded-none',
            'sm' => 'rounded-sm',
            'default' => 'rounded',
            'md' => 'rounded-md',
            'lg' => 'rounded-lg',
            'xl' => 'rounded-xl',
            '2xl' => 'rounded-2xl'
        ];

        $paddings = [
            'p-1',
            'p-2',
            'p-3',
            'p-4',
            'p-5',
            'p-6',
            'p-7',
            'p-8',
            'p-9',
            'p-10',
            'p-11',
            'p-12',
            'p-14',
        ];

        $margins = [
            'm-1',
            'm-2',
            'm-3',
            'm-4',
            'm-5',
            'm-6',
            'm-7',
            'm-8',
            'm-9',
            'm-10',
            'm-11',
            'm-12',
            'm-14',
        ];

        return view('properties')
            ->with("colors", $colors)
            ->with("opacities", $opacities)
            ->with("shadows", $shadows)
            ->with("paddings", $paddings)
            ->with("rounded", $rounded)
            ->with("margins", $margins);
    }

    public function update(Request $request, $key) {
        $value = $request->input('value');

        return $this->updateProperty($key, $value);
    }

    private function updateProperty($key, $value) {
        Property::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        return redirect()->route('properties');
    }
}
