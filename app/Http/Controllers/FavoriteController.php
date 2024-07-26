<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;

class FavoriteController extends Controller
{
    
    public function index()
    {
        $user = Auth::user();
        $properties = $user->favorites; 

        // Extract photos in the format required
        $properties->each(function($property) {
            if (isset($property->photos) && !is_array($property->photos)) {
                $property->photos = json_decode($property->photos, true);
            }
        });

        return view('fav', compact('properties'));
    }
    
    public function toggle(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['status' => 'unauthorized'], 401);
        }

        $propertyId = $request->input('property_id');
        $user = Auth::user();

        if ($user->favorites()->where('property_id', $propertyId)->exists()) {
            $user->favorites()->detach($propertyId);
            return response()->json(['status' => 'removed']);
        } else {
            $user->favorites()->attach($propertyId);
            return response()->json(['status' => 'added']);
        }
    }
}
