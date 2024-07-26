@extends('app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Éditer la propriété</h1>

    <div class="max-w-4xl mx-auto">
        <form action="{{ route('admin.updateProperty', $property->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <!-- Type -->
            <div class="mb-4">
                <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Type</label>
                <select id="type" name="type" class="form-select w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="Appartement" {{ $property->type == 'Appartement' ? 'selected' : '' }}>Appartement</option>
                    <option value="Maison" {{ $property->type == 'Maison' ? 'selected' : '' }}>Maison</option>
                </select>
            </div>

            <!-- Surface -->
            <div class="mb-4">
                <label for="surface" class="block text-gray-700 text-sm font-bold mb-2">Surface (m²)</label>
                <input type="number" id="surface" name="surface" value="{{ $property->surface }}" class="form-input w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- Adresse -->
            <div class="mb-4">
                <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Adresse</label>
                <input type="text" id="address" name="address" value="{{ $property->address }}" class="form-input w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- Ville -->
            <div class="mb-4">
                <label for="city" class="block text-gray-700 text-sm font-bold mb-2">Ville</label>
                <input type="text" id="city" name="city" value="{{ $property->city }}" class="form-input w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- Ville -->
            <div class="mb-4">
                <label for="zip" class="block text-gray-700 text-sm font-bold mb-2">Code postal</label>
                <input type="numeric" id="zip" name="zip" value="{{ $property->zip }}" class="form-input w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- Statut -->
            <div class="mb-4">
                <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Statut</label>
                <select id="status" name="status" class="form-select w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="vente" {{ $property->status == 'vente' ? 'selected' : '' }}>Vente</option>
                    <option value="location" {{ $property->status == 'location' ? 'selected' : '' }}>Location</option>
                </select>
            </div>

            <!-- Prix -->
            <div class="mb-4">
                <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Prix (€)</label>
                <input type="number" id="price" name="price" value="{{ $property->price }}" class="form-input w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- État -->
            <div class="mb-4">
                <label for="state" class="block text-gray-700 text-sm font-bold mb-2">État</label>
                <select id="state" name="state" class="form-select w-full border-gray-300 rounded-md shadow-sm">
                    <option value="Neuf" {{ $property->state == 'Neuf' ? 'selected' : '' }}>Neuf</option>
                    <option value="Rénové" {{ $property->state == 'Rénové' ? 'selected' : '' }}>Rénové</option>
                    <option value="Plateau" {{ $property->state == 'Plateau' ? 'selected' : '' }}>Plateau</option>
                </select>
            </div>

            <!-- Chambres -->
            <div class="mb-4">
                <label for="rooms" class="block text-gray-700 text-sm font-bold mb-2">Chambres</label>
                <input type="number" id="rooms" name="rooms" value="{{ $property->rooms }}" class="form-input w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Salles de bains -->
            <div class="mb-4">
                <label for="sdb" class="block text-gray-700 text-sm font-bold mb-2">Salles de bains</label>
                <input type="number" id="sdb" name="sdb" value="{{ $property->sdb }}" class="form-input w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Extras -->
            <div class="mb-4">
                <label for="extras" class="block text-gray-700 text-sm font-bold mb-2">Extras</label>
                <select id="extras" name="extras[]" class="form-multiselect w-full border-gray-300 rounded-md shadow-sm" multiple>
                    @php
                        $extras = json_decode($property->extras, true);
                        $availableExtras = ['Garage', 'Parking', 'Terrain'];
                    @endphp
                    @if($extras)
                        @foreach($availableExtras as $extra)
                            <option value="{{ strtolower($extra) }}" {{ in_array($extra, $extras) ? 'selected' : '' }}>{{ $extra }}</option>
                        @endforeach
                    @else
                        @foreach($availableExtras as $extra)
                            <option value="{{ $extra }}">{{ $extra }}</option>
                        @endforeach
                    @endif
                    
                </select>
            </div>

            <!-- Photos -->
            <div class="mb-4">
                <label for="photos" class="block text-gray-700 text-sm font-bold mb-2">Photos</label>
                <input type="file" id="photos" name="photos[]" multiple class="form-input w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Mettre à jour</button>
        </form>
    </div>
</div>
@endsection
