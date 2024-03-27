<?php

namespace App\Http\Controllers;

use App\enum\ComponentType;
use App\Http\Requests\AddComponentRequest;
use App\Models\Component;
use App\Services\ImagesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingPageCreatorController extends Controller
{
    public function index()
    {
        $id = Auth::id();

        return view('landing-page-editor', [
            'components' => Component::where('user_id', $id)->orderBy('order')->get()
        ]);
    }

    public function addComponent(AddComponentRequest $request)
    {
        $type = ComponentType::from($request->input('type'));
        $json = "";
        $imagePath = "";

        if ($type == ComponentType::IMAGE) {
            $randomName = md5(uniqid(rand(), true));

            $imgService = new ImagesService();
            $imgService->store($request->file('image'), 'images/landing', $randomName);

            $imagePath = '/images/landing/' . $randomName . '.' . $request->file('image')->getClientOriginalExtension();
        }

        switch ($type) {
            case ComponentType::TEXT:
                $json = json_encode([
                    'text' => $request->input('text'),
                    'size' => $request->input('size'),
                ]);
                break;

            case ComponentType::IMAGE:
                $json = json_encode([
                    'imagePath' => $imagePath,
                    'description' => $request->input('description'),
                ]);
                break;
        }

        $order = Component::where('user_id', Auth::id())->max('order') + 1;

        $component = new Component();
        $component->user_id = Auth::id();
        $component->type = $type;
        $component->property = $json;
        $component->order = $order;

        $component->save();

        return redirect()->route('landing.editor');
    }

    public function removeComponent($id)
    {
        $component = Component::find($id);
        $component->delete();

        $this->fixOrder();

        return redirect()->route('landing.editor');
    }

    public function moveComponentUp($id)
    {
        $component = Component::find($id);
        $order = $component->order;

        $componentAbove = Component::where('user_id', Auth::id())->where('order', $order - 1)->first();

        if($componentAbove == null)
            return redirect()->route('landing.editor');

        $componentAbove->order = $order;
        $componentAbove->save();

        $component->order = $order - 1;
        $component->save();

        return redirect()->route('landing.editor');
    }

    public function moveComponentDown($id)
    {
        $component = Component::find($id);
        $order = $component->order;

        $componentBelow = Component::where('user_id', Auth::id())->where('order', $order + 1)->first();

        if($componentBelow == null)
            return redirect()->route('landing.editor');

        $componentBelow->order = $order;
        $componentBelow->save();

        $component->order = $order + 1;
        $component->save();

        return redirect()->route('landing.editor');
    }

    public function updateColor(Request $request) {
        $user = Auth::user();
        $user->color = $request->input('color');
        $user->save();

        return redirect()->route('landing.editor');
    }

    private function fixOrder()
    {
        $components = Component::where('user_id', Auth::id())->orderBy('order')->get();

        $order = 1;
        foreach ($components as $component) {
            $component->order = $order;
            $component->save();

            $order++;
        }
    }
}
