<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\SitesController;
use App\Http\Controllers\Api\V1\SubscriptionController;


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

// your localhost -> /api/documentation for test !!!

// Routes related to website management
Route::post('/create-website',[SitesController::class,'createWebsite']); // Creates a new website
Route::get('/get-website',[SitesController::class,'getWebsite']); // Retrieves a specific website
Route::get('/get-all-websites',[SitesController::class,'getAllWebsites']); // Retrieves all websites

// Routes related to post management
Route::post('/create-post',[PostController::class,'createPost']); // Creates a new post
Route::get('/get-post',[PostController::class,'getPost']); // Retrieves a specific post
Route::get('/get-all-posts',[PostController::class,'getAllPosts']); // Retrieves all posts
Route::get('/get-website-posts',[PostController::class,'getWebsitePosts']); // Retrieves posts belonging to a specific website

// Routes related to subscription management
Route::post('/subscribe',[SubscriptionController::class,'subscribe']); // Subscribes a user
Route::get('/get-subscriber',[SubscriptionController::class,'getSubscriber']); // Retrieves a specific subscriber
Route::get('/get-all-subscribers',[SubscriptionController::class,'getAllSubscribers']); // Retrieves all subscribers



