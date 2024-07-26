@extends('app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Détails de la propriété</h1>
    
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Carousel des images -->
        @if($photos)
        <div class="relative w-full" style="max-height: 60vh; overflow: hidden;">
            <div class="absolute top-2 left-2 z-10">
                @auth
                    <button class="favorite-toggle focus:outline-none" data-property-id="{{ $property->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="{{ Auth::user()->favorites->contains($property->id) ? 'red' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </button>
                @endauth
            </div>
            <div class="carousel-wrapper relative w-full h-full flex overflow-x-auto">
                @foreach($photos as $photo)
                    <div class="flex-shrink-0 w-full h-full flex items-center justify-center">
                        <img src="data:image/{{ $photo['type'] }};base64,{{ $photo['data'] }}" class="w-auto h-full object-contain" alt="Photo de la propriété" />
                    </div>
                @endforeach
            </div>
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
            <p class="text-gray-600 mb-4">Etat : {{ $property->state }}</p>
            <p class="text-gray-600 mb-4">Chambre(s): {{ $property->rooms }}</p> 
            <p>Salle(s)de bains: {{ $property->sdb }}</p>
            <!-- Section des extras -->
        <div class="p-4">
            <h2 class="text-lg font-semibold mb-2">Extras</h3>
            <ul class="list-disc list-inside text-gray-600">
                @php
                    // Décoder les extras et définir un mapping des clés aux descriptions lisibles
                    $extras = json_decode($property->extras, true);
                    $extrasDescriptions = [
                        'garage' => 'Garage',
                        'parking' => 'Parking',
                        'terrain' => 'Terrain',
                        // Ajoutez d'autres mappages si nécessaire
                    ];
                @endphp
                @if(is_array($extras) && !empty($extras))
                    @foreach($extras as $key => $value)
                        @if(isset($extrasDescriptions[$key]) && $value)
                            <li>{{ $extrasDescriptions[$key] }}</li>
                        @endif
                    @endforeach
                @else
                    <li>Aucun extra disponible pour cette propriété.</li>
                @endif
            </ul>
        </div>
            <a href="{{ route('properties.index') }}" class="text-blue-500 hover:underline">Retour à la liste des propriétés</a>
        </div>
        

        <!-- Carte Google Maps -->
        <div id="map" class="w-full h-64 mt-6 rounded-lg shadow-md"></div>
    </div>
</div>
<script>
function initMap() {
    // Adresse à géocoder
    var address = "{{ $property->address }}, {{ $property->city }} {{ $property->zip }}";
    
    var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: { lat: -34.397, lng: 150.644 } // Valeurs par défaut avant géocodage
    });
    var geocoder = new google.maps.Geocoder();

    geocoder.geocode({ 'address': address }, function(results, status) {
        if (status === 'OK') {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });
        } else {
            alert('Géocodage impossible : ' + status);
        }
    });
}
</script>

@endsection
