<!-- create-property.blade.php -->
@extends('app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Ajouter une nouvelle propriété</h1>

    <form action="{{ route('admin.storeProperty') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md w-1/2 mx-auto">
        @csrf

        <div class="mb-4">
            <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Type</label>
            <select id="type" name="type" class="form-select w-full bg-gray-100 border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:border-blue-500" required>
                <option value="Appartement">Appartement</option>
                <option value="Maison">Maison</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="surface" class="block text-gray-700 text-sm font-bold mb-2">Surface (m²)</label>
            <input type="number" id="surface" name="surface" class="form-input w-full bg-gray-100 border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Adresse</label>
            <input type="text" id="address" name="address" class="form-input w-full bg-gray-100 border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="city" class="block text-gray-700 text-sm font-bold mb-2">Ville</label>
            <input type="text" id="city" name="city" class="form-input w-full bg-gray-100 border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="zip" class="block text-gray-700 text-sm font-bold mb-2">Code Postal (ZIP)</label>
            <input type="text" id="zip" name="zip" class="form-input w-full bg-gray-100 border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Statut</label>
            <select id="status" name="status" class="form-select w-full bg-gray-100 border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:border-blue-500" required>
                <option value="vente">Vente</option>
                <option value="location">Location</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Prix (€)</label>
            <input type="number" id="price" name="price" class="form-input w-full bg-gray-100 border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="state" class="block text-gray-700 text-sm font-bold mb-2">État</label>
            <select id="state" name="state" class="form-select w-full bg-gray-100 border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:border-blue-500">
                <option value="">Choisir un état</option>
                <option value="Neuf">Neuf</option>
                <option value="Rénové">Rénové</option>
                <option value="Plateau">Plateau</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="rooms" class="block text-gray-700 text-sm font-bold mb-2">Chambres</label>
            <input type="number" id="rooms" name="rooms" class="form-input w-full bg-gray-100 border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="sdb" class="block text-gray-700 text-sm font-bold mb-2">Salles de bains</label>
            <input type="number" id="sdb" name="sdb" class="form-input w-full bg-gray-100 border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="extras" class="block text-gray-700 text-sm font-bold mb-2">Extras</label>
            <select id="extras" name="extras[]" multiple class="form-select w-full bg-gray-100 border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:border-blue-500">
                <!-- Les options doivent être générées dynamiquement en fonction des extras disponibles -->
                <option value="1">Garage</option>
                <option value="2">Parking</option>
                <option value="3">Terrain</option>
                <!-- Ajouter ici d'autres options si nécessaire -->
            </select>
        </div>

        <div class="mb-4">
            <label for="photos" class="block text-gray-700 text-sm font-bold mb-2">Photos</label>
            <input type="file" id="photos" name="photos[]" multiple class="form-input w-full bg-gray-100 border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:border-blue-500">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Enregistrer</button>
    </form>
</div>
@endsection
