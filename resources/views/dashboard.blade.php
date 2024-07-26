@extends('app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Panneau d'administration</h1>

    <div class="bg-white rounded-lg shadow-md p-6">
        <p class="text-lg font-semibold mb-4">Choisissez une option :</p>
        <div class="space-y-4">
            <a href="{{ route('admin.manageProperties') }}" class="block text-center bg-blue-600 text-white py-3 px-6 rounded-lg shadow-md hover:bg-blue-700 transition-colors">Gérer les biens</a>
            <a href="{{ route('admin.manageUsers') }}" class="block text-center bg-green-600 text-white py-3 px-6 rounded-lg shadow-md hover:bg-green-700 transition-colors">Gérer les utilisateurs</a>
        </div>
    </div>
</div>
@endsection
