@extends('app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Liste des propriétés</h1>

    <!-- Formulaire de recherche et filtres -->
    <form method="GET" action="{{ route('properties.index') }}" class="mb-6">
        <div class="flex space-x-4">
            <input type="text" name="search" placeholder="Rechercher par ville, code postal, etc."
                   class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="{{ request('search') }}">
            <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Rechercher
            </button>
        </div>
    </form>

    <!-- Filtres de recherche -->
    <form method="GET" action="{{ route('properties.index') }}" class="mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="flex items-center space-x-4">
                <label class="flex items-center">
                    <input type="radio" name="status" value="vente" 
                           class="mr-2" {{ request('status') == 'vente' ? 'checked' : '' }}>
                    <span> Acheter</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="status" value="location" 
                           class="mr-2" {{ request('status') == 'location' ? 'checked' : '' }}>
                    <span> Louer</span>
                </label>
            </div>
            <div>
                <input type="text" name="location" placeholder="Localisation" 
                       class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ request('location') }}">
            </div>
            <div>
                <input type="number" name="budget_min" placeholder="Budget Min"
                       class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ request('budget_min') }}">
            </div>
            <div>
                <input type="number" name="budget_max" placeholder="Budget Max"
                       class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ request('budget_max') }}">
            </div>
        </div>
        <div class="mt-4">
            <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Filtrer
            </button>
            <a href="{{ route('properties.index') }}"
               class="bg-gray-300 text-black px-4 py-2 rounded-lg hover:bg-gray-400">
                Réinitialiser
            </a>
        </div>
    </form>

    <!-- Liste des propriétés -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($properties as $property)
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6 relative">
                <!-- Icône de favori -->
                <div class="absolute top-2 left-2 z-10">
                    <button class="favorite-toggle focus:outline-none" data-property-id="{{ $property->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="{{ in_array($property->id, $favorites) ? 'red' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </button>
                </div>

                <!-- Carrousel des images -->
                @if(is_array($property->photos) && count($property->photos) > 0)
                    <div class="photo-carousel">
                        @foreach($property->photos as $photo)
                            <div>
                                <img src="data:image/{{ $photo['type'] }};base64,{{ $photo['data'] }}" class="w-full object-cover" alt="Photo de la propriété">
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="p-4">
                    <h2 class="text-lg font-semibold mb-2">{{ $property->type }} - {{ $property->surface }} m²</h2>
                    <p class="text-gray-600 mb-4">{{ $property->address }}, {{ $property->city }}</p>
                    <p class="text-gray-900 font-bold mb-2">
                        @if($property->status == 'location')
                            Location - {{ $property->price }} € /mois
                        @else
                            Vente - {{ $property->price }} €
                        @endif
                    </p>
                    <a href="{{ route('properties.show', $property->id) }}" class="text-blue-500 hover:underline">Voir les détails</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
