<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            // Afficher la vue pour les admins
            return view('dashboard');
        } else {
            // Rediriger ou afficher un message d'erreur
            return redirect()->route('home')->with('error', 'Vous n\'avez pas les droits nécessaires.');
        }
    }

    public function manageProperties()
    {
        if(Auth::check() && Auth::user()->role === 'admin'){
            // Récupère toutes les propriétés depuis la base de données
            $properties = Property::all()->map(function($property) {
                $property->photos = json_decode($property->photos, true);
                return $property;
            });

            // Passe les propriétés à la vue
            return view('manage-properties', compact('properties'));
        } else {
            return redirect()->route('home')->with('error', 'Vous n\'avez pas les droits nécessaires.');
        }
    }

    public function createProperty()
    {
        if(Auth::check() && Auth::user()->role === 'admin'){
            return view('create-property'); // La vue pour le formulaire de création
        } else {
            return redirect()->route('home')->with('error', 'Vous n\'avez pas les droits nécessaires.');
        }
    }

    public function editProperty($id)
    {
        if(Auth::check() && Auth::user()->role === 'admin'){
            $property = Property::findOrFail($id);
            return view('edit-property', compact('property'));
        } else {
            return redirect()->route('home')->with('error', 'Vous n\'avez pas les droits nécessaires.');
        }
    }


// PropertyController.php
public function storeProperty(Request $request)
{
    // Validation des données entrantes
    $request->validate([
        'type' => 'required|string|max:255',
        'surface' => 'required|numeric',
        'address' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'zip' => 'required|string|regex:/^\d{5}(-\d{4})?$/',
        'status' => 'required|string|in:vente,location',
        'price' => 'nullable|numeric',
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

    // Création de la propriété avec des valeurs par défaut pour name et firstName
    Property::create([
        'name' => 'admin', // Valeur par défaut
        'firstName' => 'admin', // Valeur par défaut
        'address' => $request->address,
        'city' => $request->city,
        'zip' => $request->zip,
        'surface' => $request->surface,
        'type' => $request->type,
        'state' => $request->status,
        'rooms' => $request->input('rooms', 0), // Valeur par défaut pour les chambres
        'sdb' => $request->input('sdb', 0), // Valeur par défaut pour les salles de bains
        'extras' => json_encode($request->input('extras', [])), // Valeur par défaut pour extras
        'photos' => json_encode($photos),
    ]);

    return redirect()->route('admin.manageProperties')->with('success', 'Propriété ajoutée avec succès');
}



    public function updateProperty(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'type' => 'required|string',
            'surface' => 'required|numeric',
            'address' => 'required|string',
            'city' => 'required|string',
            'status' => 'required|string',
            'price' => 'required|numeric',
            'state' => 'nullable|string',
            'rooms' => 'nullable|integer',
            'sdb' => 'nullable|integer',
            'extras' => 'nullable|array',
            'photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Récupération de la propriété
        $property = Property::findOrFail($id);

        // Préparation des extras
        $extras = $request->input('extras', []);
        $formattedExtras = [];
        if (is_array($extras)) {
            foreach ($extras as $extra) {
                $formattedExtras[$extra] = '1'; // Associe chaque extra avec la valeur "1"
            }
        }
        
        // Traitement des photos
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

        // Mise à jour des données de la propriété
        $property->update([
            'type' => $request->input('type'),
            'surface' => $request->input('surface'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'status' => $request->input('status'),
            'price' => $request->input('price'),
            'state' => $request->input('state'),
            'rooms' => $request->input('rooms'),
            'sdb' => $request->input('sdb'),
            'extras' => json_encode($formattedExtras),
            'photos' => json_encode($photos),
        ]);

        return redirect()->route('admin.manageProperties')->with('success', 'Propriété mise à jour avec succès.');
    }


    public function getFavorites($id)
    {
        if(Auth::check() && Auth::user()->role === 'admin'){
            $property = Property::findOrFail($id);
            $favorites = $property->favoritedBy()->select('email')->get(); // Assurez-vous de sélectionner les champs nécessaires
            return response()->json($favorites);
        } else {
            return redirect()->route('home')->with('error', 'Vous n\'avez pas les droits nécessaires.');
        }

    }


    public function deleteProperty($id)
    {
        if(Auth::check() && Auth::user()->role === 'admin'){
            $property = Property::findOrFail($id);
            $property->delete();
            return redirect()->route('admin.manageProperties')->with('success', 'Propriété supprimée avec succès.');
        } else {
            return redirect()->route('home')->with('error', 'Vous n\'avez pas les droits nécessaires.');
        }
    }

    public function manageUsers()
    {
        if(Auth::check() && Auth::user()->role === 'admin'){
            // Récupérer les utilisateurs avec le rôle 'client'
            $clients = User::where('role', 'client')->get();
    
            // Passer les utilisateurs à la vue
            return view('manage-users', compact('clients'));
        } else {
            return redirect()->route('home')->with('error', 'Vous n\'avez pas les droits nécessaires.');
        }
    }
}
