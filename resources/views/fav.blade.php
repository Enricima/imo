@extends('app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Mes Favoris</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($properties as $property)
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6 relative">
                <!-- Icône de favori -->
                <div class="absolute top-2 left-2 z-10">
                    <button class="favorite-toggle focus:outline-none" data-property-id="{{ $property->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-red-500">
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
                    <a href="{{ route('properties.show', $property->id) }}" class="text-blue-500 hover:underline">Voir les détails</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
