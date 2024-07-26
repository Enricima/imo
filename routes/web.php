<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;

// Nav
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/properties', function(){
    return view('properties');
})->name('properties');

Route::get('/sell', function(){
    return view('sell');

})->name('sell');

Route::get('/us', function(){
    return view('us');

})->name('us');

Route::get('/contact', function(){
    return view('contact');

})->name('contact');


// Register, Login and Logout
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Infos perso
Route::get('/me', function(){
    return view('me');
})->name('me');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Properties
Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{id}', [PropertyController::class, 'show'])->name('properties.show');

//Favorites
Route::middleware(['auth'])->group(function () {
    Route::get('/fav', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
});

//Admin dashboard
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/manage-properties', [AdminController::class, 'manageProperties'])->name('admin.manageProperties');
Route::get('/admin/manage-users', [AdminController::class, 'manageUsers'])->name('admin.manageUsers');

Route::get('properties/{id}/edit', [AdminController::class, 'editProperty'])->name('admin.editProperty');
Route::get('/admin/property/favorites/{id}', [AdminController::class, 'getFavorites']);
Route::delete('properties/{id}', [AdminController::class, 'deleteProperty'])->name('admin.deleteProperty');
Route::put('/properties/{id}', [AdminController::class, 'updateProperty'])->name('admin.updateProperty');
Route::get('/admin/properties/create', [AdminController::class, 'createProperty'])->name('admin.createProperty');
Route::post('/admin/properties', [AdminController::class, 'storeProperty'])->name('admin.storeProperty');

//Contact
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');


