<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityReview;
use App\Http\Controllers\PlacesController;
use App\Http\Controllers\ReviewCity;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReviewHotel;
use App\Http\Controllers\ReviewLandmark;
use App\Http\Controllers\ReviewResturant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/auth', function (Request $request) {
    return response()->Json(['message' => 'please login first']);
})->name('auth');

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('/Cities/Explore', [PlacesController::class, 'CitiesAction']);
Route::get('/Cities/Explore/{Cityid}', [PlacesController::class, 'ShowOneCity']);

Route::get('/Landmarks/Explore', [PlacesController::class, 'LandmarksAction']);
Route::get('/Landmarks/Explore/{Landmarkid}', [PlacesController::class, 'ShowOneLandmark']);

Route::get('/Resturants/Explore', [PlacesController::class, 'ResturantsAction']);
Route::get('/Resturants/Explore/{Resturantid}', [PlacesController::class, 'ShowOneResturant']);

Route::get('/Hotels/Explore', [PlacesController::class, 'HotelsAction']);
Route::get('/Hotels/Explore/{Hotelid}', [PlacesController::class, 'ShowOneHotel']);

// import hotels
// Route::get('/Hotels', [PlacesController::class, 'AllHotelsAction']);


// Route::post('/Cities/{cityId}/AddReviews', [ReviewController::class, 'addReviewToCity']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/Cities/AddCityReview/{cityid}', [ReviewCity::class, 'AddReviewToCity']);
    Route::post('/Hotels/AddHotelReview/{hotelid}', [ReviewHotel::class, 'AddReviewToHotel']);
    Route::post('/Landmarks/AddLandmarkReview/{Landmarkid}', [ReviewLandmark::class, 'AddReviewToLandmark']);
    Route::post('/Resturants/AddResturantReview/{Resturantid}', [ReviewResturant::class, 'AddReviewToResturant']);
});

Route::get('/Cities/CityReview/{cityid}', [ReviewCity::class, 'GetReviewsForCity']);
Route::get('/Hotels/HotelReview/{hotelid}', [ReviewHotel::class, 'GetReviewsForHotel']);
Route::get('/Landmarks/LandmarkReview/{Landmarkid}', [ReviewLandmark::class, 'GetReviewsForLandmark']);
Route::get('/Resturants/ResturantReview/{Resturantid}', [ReviewResturant::class, 'GetReviewsForResturant']);


