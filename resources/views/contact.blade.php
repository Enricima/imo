@extends('app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Nous contacter</h1>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <p class="text-gray-700 mb-6">Si vous avez des questions ou des préoccupations, veuillez remplir le formulaire ci-dessous. Nous nous engageons à vous répondre dans les plus brefs délais.</p>
            <!-- Formulaire de contact -->
            <form action="{{ route('contact.submit') }}" method="POST">
                @csrf
                <!-- Champ email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                </div>
                <!-- Champ objet -->
                <div class="mb-4">
                    <label for="subject" class="block text-sm font-medium text-gray-700">Objet</label>
                    <input type="text" id="subject" name="subject" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                </div>

                <!-- Champ contenu -->
                <div class="mb-4">
                    <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                    <textarea id="message" name="message" rows="6" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required></textarea>
                </div>

                <!-- Bouton de soumission -->
                <div>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Envoyer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
