@extends('app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Gérer les utilisateurs - Clients</h1>

    <!-- Table des utilisateurs -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        @if($clients->isEmpty())
            <p class="text-gray-700">Aucun utilisateur avec le rôle 'client' trouvé.</p>
        @else
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-200 text-gray-800 text-left">Nom</th>
                        <th class="py-2 px-4 border-b border-gray-200 text-gray-800 text-left">Prénom</th>
                        <th class="py-2 px-4 border-b border-gray-200 text-gray-800 text-left">Email</th>
                        <th class="py-2 px-4 border-b border-gray-200 text-gray-800 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $client->name }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $client->first_name }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $client->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
