<?php

use Illuminate\Support\Facades\Route;
use App\Models\Listing;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('example-auth');
// });
Route::view("/welcome","welcome");
Route::view("/example-page","example-page");
Route::view("/example-auth","example-auth");
Route::get('/hello/{id}',function($id){
    // dd($id);
    return "Post ".$id;
})->where('id','[0-8]+');

// testing routes(all listings)
Route::get('/',[ListingController::class,'index']);


// // testing routes(single listing)
// Route::get('/listing/{id}',function($id){
//     $listing = Listing::find($id);
//     if($listing){
//         return view('listing',[
//             'heading'=>'Single News',
//             'listing'=> $listing
//         ]);
//     }else{
//         abort(404);
//     }
    
// });

// Creating form
Route::get('/listings/create',[ListingController::class,'create'])->middleware('auth');
// Store form/listing data
Route::post('/listings',[ListingController::class,'store'])->middleware('auth');
// Show Edit Form data
Route::get('/listings/{listing}/edit',[ListingController::class,'edit'])->middleware('auth');
// Edit Form data
Route::put('/listings/{listing}',[ListingController::class,'update'])->middleware('auth');
// Delete Listing data
Route::delete('/listings/{listing}',[ListingController::class,'destroy'])->middleware('auth');
// Show Regiter User Page
Route::get('/register',[UserController::class,'create'])->middleware('guest');
// Register New User
Route::post('/users',[UserController::class,'store'])->middleware('guest');
// Logout User
Route::post('/logout',[UserController::class,'logout'])->middleware('auth');
// Show Login User
Route::get('/login',[UserController::class,'login'])->name('login')->middleware('guest');
// Login User
Route::post('/users/authenticate',[UserController::class,'authenticate']);
// Managing Listings
Route::get('/listings/manage',[ListingController::class,'manage'])->middleware('auth');


// Alternative testing routes(single listing) -this should be at the bottom
Route::get('/listing/{listing}',[ListingController::class,'show']);

