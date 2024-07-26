<?php
namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        // Recherche globale indépendante
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $properties = Property::where(function($query) use ($searchTerm) {
                $query->where('city', 'like', '%' . $searchTerm . '%')
                      ->orWhere('zip', 'like', '%' . $searchTerm . '%')
                      ->orWhere('name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('address', 'like', '%' . $searchTerm . '%')
                      ->orWhere('type', 'like', '%' . $searchTerm . '%')
                      ->orWhere('state', 'like', '%' . $searchTerm . '%')
                      ->orWhere('rooms', 'like', '%' . $searchTerm . '%')
                      ->orWhere('sdb', 'like', '%' . $searchTerm . '%');
            })->get();
        } else {
            $properties = Property::all();
        }
    
        // Filtrage supplémentaire
        if ($request->filled('status')) {
            $properties = $properties->where('status', $request->status);
        }
    
        if ($request->filled('location')) {
            $location = $request->location;
            $properties = $properties->where(function($query) use ($location) {
                $query->where('city', 'like', '%' . $location . '%')
                      ->orWhere('zip', 'like', '%' . $location . '%');
            });
        }
    
        if ($request->filled('budget_min')) {
            $properties = $properties->where('price', '>=', $request->budget_min);
        }
    
        if ($request->filled('budget_max')) {
            $properties = $properties->where('price', '<=', $request->budget_max);
        }
    
        // Traitement des photos et récupération des favoris
        $properties = $properties->map(function($property) {
            $property->photos = json_decode($property->photos, true);
            return $property;
        });
    
        $user = Auth::user();
        $favorites = $user ? $user->favorites->pluck('id')->toArray() : [];
    
        return view('properties', compact('properties', 'favorites'));
    }
    


    

    public function show($id)
    {
        // Récupère une propriété spécifique
        $property = Property::findOrFail($id);

        $photos = json_decode($property->photos, true);

        // Passe la propriété à la vue
        return view('show', compact('property', 'photos'));
    }

    public function create()
    {
        return view('property.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip' => 'required|string|regex:/^\d{5}(-\d{4})?$/',
            'surface' => 'required|numeric',
            'type' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'rooms' => 'required|integer',
            'sdb' => 'required|integer',
            'extras' => 'nullable|array',
            'photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $photos = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $imageData = base64_encode(file_get_contents($photo));
                $photos[] = [
                    'name' => $photo->getClientOriginalName(),
                    'data' => $imageData,
                    'type' => $photo->getMimeType()
                ];

                
            }
        }

        Property::create([
            'name' => $request->name,
            'firstName' => $request->firstName,
            'address' => $request->address,
            'city' => $request->city,
            'zip' => $request->zip,
            'surface' => $request->surface,
            'type' => $request->type,
            'state' => $request->state,
            'rooms' => $request->rooms,
            'sdb' => $request->sdb,
            'extras' => json_encode($request->extras),
            'photos' => json_encode($photos),
        ]);

        return redirect()->route('properties.index')->with('success', 'Property added successfully');
    }
}
