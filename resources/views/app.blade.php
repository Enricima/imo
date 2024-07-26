<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>App</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <header>
    <nav class="bg-white dark:bg-gray-900 w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
      <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <a href="{{route('home')}}" class="flex items-center space-x-3 rtl:space-x-reverse">
          <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Imo</span>
      </a>
      <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
        @guest
          <a href="{{ route('login') }}">
            <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Connexion</button>
          </a>
        @else 
          <a href="{{route('me')}}" class="transition-transform duration-300 hover:scale-110"><span class="text-gray-900 dark:text-white pr-2">{{ Auth::user()->first_name }} {{ Auth::user()->name }}</span></a>
          <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Déconnexion</button>
          </form>
        @endguest
    
      </div>
      <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1">
        <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
          <li>
            <a href="{{ route('home') }}" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Accueil</a>
          </li>
          <li>
            <a href="{{ route('properties.index') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Annonces</a>
          </li>
          <li>
            <a href="{{ route('sell') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Vendre</a>
          </li>
          <li>
            <a href="{{ route('us') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Qui sommes nous ?</a>
          </li>
          <li>
            <a href="{{ route('contact') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Nous contacter</a>
          </li>
          <li>
            <a href="{{ route('favorites.index') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Favoris</a>
          </li>
        </ul>
      </div>
      </div>
    </nav>
    @if(session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
          <strong class="font-bold">Success!</strong>
          <span class="block sm:inline">{{ session('success') }}</span>
      </div>
    @endif
    @if($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
          <strong class="font-bold">Error!</strong>
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif

  </header>


  <div class="container mx-auto pt-24">
    <main>
      @yield('content')
    </main>
  </div>
  
  <!-- Admin Button -->
  @auth
    @if(Auth::user()->role === 'admin')
      <a href="{{ route('admin.dashboard') }}" class="fixed bottom-4 right-4 bg-blue-600 text-white py-2 px-4 rounded-full shadow-lg hover:bg-blue-700 transition-colors">Panneau d'administration</a>
    @endif
  @endauth
    
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAg41oahu9jV5dqpYiJjxdy3lBflVe7oJo&callback=initMap&libraries=&v=weekly" async></script>


<script>
$(document).ready(function(){
    $('.photo-carousel').slick({
        dots: true,
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 3000,
        arrows: true,
    });
});
</script>

<script>
  $(document).ready(function() {
      $('.favorite-toggle').click(function(event) {
          event.preventDefault();

          var button = $(this);
          var propertyId = button.data('property-id');
          
          $.ajax({
              url: "{{ route('favorites.toggle') }}",
              method: 'POST',
              data: {
                  property_id: propertyId,
                  _token: "{{ csrf_token() }}"
              },
              success: function(response) {
                  if (response.status === 'added') {
                      button.find('svg').attr('fill', 'red');
                  } else if (response.status === 'removed') {
                      button.find('svg').attr('fill', 'none');
                  }

                  // Recharger la page après avoir modifié les favoris
                  location.reload();
              }
          });
      });
  });
</script>


</html>