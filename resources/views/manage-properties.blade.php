@extends('app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Gérer les propriétés</h1>
    
    <!-- Bouton Ajouter un nouveau bien -->
    <a href="{{ route('admin.createProperty') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-6 inline-block">Ajouter un nouveau bien</a>

    <!-- Liste des propriétés -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($properties as $property)
            <div class="bg-white rounded-lg shadow-md overflow-hidden relative">
                <!-- Image de la propriété -->
                @if(is_array($property->photos) && count($property->photos) > 0)
                    <img src="data:image/{{ $property->photos[0]['type'] }};base64,{{ $property->photos[0]['data'] }}" class="w-full h-48 object-cover" alt="Photo de la propriété">
                @else
                    <img src="https://via.placeholder.com/600x400" class="w-full h-48 object-cover" alt="Image de la propriété">
                @endif

                <!-- Contenu de la propriété -->
                <div class="p-4">
                    <h2 class="text-lg font-semibold mb-2">{{ $property->type }} - {{ $property->surface }} m²</h2>
                    <p class="text-gray-600 mb-4">{{ $property->address }}, {{ $property->city }}</p>
                </div>

                <!-- Boutons d'action -->
                <div class="absolute top-2 right-2 flex space-x-2">
                    <!-- Bouton Modifier -->
                    <a href="{{ route('admin.editProperty', $property->id) }}" class="text-blue-600 hover:text-blue-800" title="Modifier">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6">
                            <path d="M17.657 6.343a1 1 0 00-1.414 0L4.828 16.828a1 1 0 00-.293.707v3.415A1 1 0 004.828 22H8.24a1 1 0 00.707-.293l11.415-11.415a1 1 0 000-1.414L17.657 6.343z"/>
                        </svg>
                    </a>

                    <!-- Bouton Voir les Favoris (œil) -->
                    <button class="text-green-600 hover:text-green-800" title="Voir les favoris" onclick="showFavorites({{ $property->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6">
                            <path d="M12 4.5C6.2 4.5 2 8.3 2 12s4.2 7.5 10 7.5S22 15.7 22 12 17.8 4.5 12 4.5zm0 11c-1.8 0-3.3-1.5-3.3-3.3S10.2 9.9 12 9.9 15.3 11.4 15.3 13.2 13.8 15.5 12 15.5zm0-7.5c-1.2 0-2.2 1-2.2 2.2S10.8 12 12 12s2.2-1 2.2-2.2S13.2 7.5 12 7.5z"/>
                        </svg>
                    </button>

                    <!-- Bouton Supprimer -->
                    <form method="POST" action="{{ route('admin.deleteProperty', $property->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800" title="Supprimer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6">
                                <path d="M6 6L6 18M18 6L6 18M18 18L6 6" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Modal pour afficher les utilisateurs favoris -->
<div id="favoritesModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-lg w-full">
        <h2 class="text-xl font-semibold mb-4">Utilisateurs ayant mis en favoris</h2>
        <ul id="favoritesList" class="list-disc pl-5">
            <!-- Les utilisateurs favoris seront insérés ici -->
        </ul>
        <button class="mt-4 px-4 py-2 bg-gray-500 text-white rounded" onclick="closeFavorites()">Fermer</button>
    </div>
    <div class="fixed inset-0 bg-black opacity-50" onclick="closeFavorites()"></div>
</div>

<script>
function showFavorites(propertyId) {
    // Requête AJAX pour obtenir les utilisateurs ayant favorisé la propriété
    $.ajax({
        url: "{{ url('/admin/property/favorites') }}/" + propertyId,
        method: 'GET',
        success: function(data) {
            $('#favoritesList').empty();
            if (data.length > 0) {
                data.forEach(function(user) {
                    $('#favoritesList').append('<li>' + user.email + '</li>');
                });
            } else {
                $('#favoritesList').append('<li>Aucun utilisateur</li>');
            }
            $('#favoritesModal').removeClass('hidden');
        }
    });
}

function closeFavorites() {
    $('#favoritesModal').addClass('hidden');
}
</script>
@endsection
