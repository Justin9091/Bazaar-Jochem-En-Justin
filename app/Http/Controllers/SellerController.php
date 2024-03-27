<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateAdvertisementRequest;
use App\Models\Component;
use App\Models\advertisement\Advertisement;
use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SellerController extends Controller
{
    public function show($userId)
    {
        // Get the user by ID with their associated customer and advertisements
        $user = User::with('customer', 'advertisements')->findOrFail($userId);

        $components = Component::where('user_id', $userId)->orderBy('order')->get();

        $logos = Storage::disk('public')->files('logos');
        foreach ($logos as $key => $logo) {
            $fullName = File::basename($logo);

            $nameWithoutExtension = substr($fullName, 0, strrpos($fullName,'.'));

            if($nameWithoutExtension == $user->id) {
                $user->customLogo = Storage::url('logos/' . $fullName);
                break;
            }
        }

        return view('sellerprofile', compact('user', 'components'))
            ->with("userid", $userId)
            ->with("logo", $user->customLogo);
    }

    public function showaddadvertisementform($userId)
    {
        return view('addadvertisement', ['userId' => $userId]);
    }
    public function createadvertisement(CreateAdvertisementRequest $request, $userId)
    {
        // Validation
        $validatedData = $request->validated();

        $type = 'rent';
        if($validatedData['type'] == 'Verkoop'){
            $type = 'sell';
        }

        $maxAdverts = 4;
        $currentAdverts = Auth::user()->advertisements()->where('type', $type)->count();

        if ($currentAdverts >= $maxAdverts) {
            return redirect()
                ->back()
                ->withErrors(__('sellersprofile.max_ads'));
        }

        // Create the advertisement
        $advertisement = new Advertisement();
        $advertisement->title = $validatedData['title'];
        $advertisement->description = $validatedData['description'];
        if($validatedData['type'] == 'Huur'){
            $advertisement->type = 'rent';
        } else {
            $advertisement->type = 'sell';
        }
        $advertisement->expires_at = $validatedData['expiration'];
        $advertisement->user_id = $userId;
        $advertisement->save();

        // Redirect back or to any other route as needed
        return redirect()->route('sellerprofile', ['userId' => $userId])->with('success', 'Advertisement created successfully.');
    }
}


