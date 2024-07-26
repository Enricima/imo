@extends('app')

@section('content')
<section class="w-1/2">
<h1 class="text-2xl font-bold mb-6">Vendre un bien</h1>
<form action="{{ route('properties.store') }}" method="POST" class="max-w mx-auto" enctype="multipart/form-data">
    @csrf
    <div class="flex justify-around w-full gap-2 pt-2 pb-2">
        <div class="w-1/2">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-900">Nom</label>
            <input type="text" name="name" id="name" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Dupont">
            @error('name')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="w-1/2">
            <label for="firstName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-900">Prénom</label>
            <input type="text" name="firstName" id="firstName" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Jean">
            @error('firstName')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="pt-2 pb-2">
        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-900">Adresse</label>
        <input type="text" name="address" id="address" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="N° + rue">
        @error('address')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="flex justify-around w-full gap-2 pt-2 pb-2">
        <div class="w-1/2">
            <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-900">Ville</label>
            <input type="text" name="city" id="city" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Paris">    
            @error('city')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="w-1/2">
            <label for="zip-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-900">ZIP code:</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                        <path d="M8 0a7.992 7.992 0 0 0-6.583 12.535 1 1 0 0 0 .12.183l.12.146c.112.145.227.285.326.4l5.245 6.374a1 1 0 0 0 1.545-.003l5.092-6.205c.206-.222.4-.455.578-.7l.127-.155a.934.934 0 0 0 .122-.192A8.001 8.001 0 0 0 8 0Zm0 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                    </svg>
                </div>
                <input type="text" id="zip-input" name="zip" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="12345 or 12345-6789" pattern="^\d{5}(-\d{4})?$" required />
            </div>
            @error('zip')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror 
        </div>
    </div>
    <div class="pt-2 pb-2">
        <label for="surface" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-900">Surface</label>
        <div class="relative flex items-center max-w-[11rem]">
            <input type="number" name="surface" id="surface" data-input-counter data-input-counter-min="1" data-input-counter-max="5" aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-11 font-medium text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full pb-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="111" required />
            <div class="absolute bottom-1 start-1/2 -translate-x-1/2 rtl:translate-x-1/2 flex items-center text-xs text-gray-400 space-x-1 rtl:space-x-reverse">
                <span>m²</span>
            </div>
        </div>
        @error('surface')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="pt-2 pb-2">
        <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-900">Type de bien</label>
        <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          <option>Appartement</option>
          <option>Maison</option>
        </select>
        @error('type')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="pt-2 pb-2">
        <label for="state" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-900">Etat</label>
        <select id="state" name="state" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          <option>Neuf</option>
          <option>Rénové</option>
          <option>Plateau</option>
        </select>
        @error('state')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="pt-2 pb-2">
        <label for="rooms" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-900">Nombre de chambre(s)</label>
        <div class="relative flex items-center max-w-[11rem]">
            <input type="number" name="rooms" id="rooms" data-input-counter data-input-counter-min="1" data-input-counter-max="5" aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-11 font-medium text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full pb-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1" required />
            <div class="absolute bottom-1 start-1/2 -translate-x-1/2 rtl:translate-x-1/2 flex items-center text-xs text-gray-400 space-x-1 rtl:space-x-reverse">
                <span>chambre(s)</span>
            </div>
        </div>
        @error('rooms')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="pt-2 pb-2">
        <label for="sdb" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-900">Nombre de salle de bains</label>
        <div class="relative flex items-center max-w-[11rem]">
            <input type="number" name="sdb" id="sdb" data-input-counter data-input-counter-min="1" data-input-counter-max="5" aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-11 font-medium text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full pb-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1" required />
            <div class="absolute bottom-1 start-1/2 -translate-x-1/2 rtl:translate-x-1/2 flex items-center text-xs text-gray-400 space-x-1 rtl:space-x-reverse">
                <span>salle(s) d'eau</span>
            </div>
        </div>
        @error('sdb')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="pt-2 pb-2">
        <h3 class="mb-4 font-semibold text-gray-900 dark:text-gray-900">Extras</h3>
        <ul class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-900">
            <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                <div class="flex items-center ps-3">
                    <input id="parking" name="extras[parking]" type="checkbox" value="1" {{ old('extras.parking') ? 'checked' : '' }} class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                    <label for="parking" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Parking</label>
                </div>
            </li>
            <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                <div class="flex items-center ps-3">
                    <input id="garage" name="extras[garage]" type="checkbox" value="1" {{ old('extras.garage') ? 'checked' : '' }} class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                    <label for="garage" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Garage</label>
                </div>
            </li>
            <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                <div class="flex items-center ps-3">
                    <input id="terrain" name="extras[terrain]" type="checkbox" value="1" {{ old('extras.terrain') ? 'checked' : '' }} class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                    <label for="terrain" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Terrain</label>
                </div>
            </li>
        </ul>        
    </div>
    <div>
        <label for="photos">Photos</label>
        <input type="file" id="photos" name="photos[]" multiple class="block w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg cursor-pointer focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        @error('photos.*')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="pt-5">
        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ajouter mon bien</button>
    </div>
</form>
  
</section>
@endsection