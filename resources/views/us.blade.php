@extends('app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Titre principal -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-gray-900 mb-4">Qui sommes-nous ?</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400">Découvrez l'histoire d'Imo, votre agence immobilière en ligne de confiance.</p>
    </div>

    <!-- Section à propos de l'entreprise -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden mb-12">
        <div class="p-6">
            <h2 class="text-3xl font-semibold text-gray-900 dark:text-white mb-4">À propos d'Imo</h2>
            <p class="text-gray-700 dark:text-gray-300 mb-4">
                Chez Imo, nous révolutionnons le marché de l'immobilier en vous offrant une plateforme en ligne simple et efficace pour vos besoins de location et de vente. Grâce à notre approche entièrement numérique, nous réduisons les coûts et simplifions le processus, vous permettant de trouver votre propriété idéale sans tracas.
            </p>
            <p class="text-gray-700 dark:text-gray-300">
                Notre équipe d'experts est dédiée à vous offrir un service de qualité supérieure. Nous sommes réactifs, professionnels, et toujours prêts à vous aider dans toutes les étapes de votre recherche immobilière.
            </p>
        </div>
    </div>

    <!-- Section des services -->
    <div class="mb-12">
        <h2 class="text-3xl font-semibold text-gray-900 dark:text-white text-center mb-6">Nos Services</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Service 1 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">Location</h3>
                    <p class="text-gray-700 dark:text-gray-300">
                        Trouvez des propriétés en location adaptées à vos besoins grâce à notre vaste catalogue. Notre plateforme facilite la recherche, la comparaison et la réservation de votre futur logement.
                    </p>
                </div>
            </div>
            <!-- Service 2 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">Vente</h3>
                    <p class="text-gray-700 dark:text-gray-300">
                        Découvrez des opportunités d'achat de biens immobiliers intéressants avec des prix compétitifs. Nous simplifions le processus d'achat et vous guidons à chaque étape.
                    </p>
                </div>
            </div>
            <!-- Service 3 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">Support Réactif</h3>
                    <p class="text-gray-700 dark:text-gray-300">
                        Notre équipe est disponible pour répondre à vos questions et vous fournir l'assistance dont vous avez besoin. Nous nous engageons à être réactifs et à résoudre rapidement tout problème.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Section de contact -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <div class="p-6">
            <h2 class="text-3xl font-semibold text-gray-900 dark:text-white mb-4">Contactez-nous</h2>
            <p class="text-gray-700 dark:text-gray-300 mb-4">
                Vous avez des questions ou avez besoin d'aide ? N'hésitez pas à nous contacter. Notre équipe est prête à vous assister et à vous offrir le meilleur service possible.
            </p>
            <a href="{{ route('contact') }}" class="text-blue-500 hover:underline">Contactez-nous ici</a>
        </div>
    </div>
</div>
@endsection
