<?php


use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

// Forntend Property Details All Route
Route::controller(IndexController::class)->group(function () {
    Route::get('/property/details/{id}/{slug}', 'PropertyDetails')->name('property.details');
    Route::post('/property/message', 'PropertyMessage')->name('property.message');
    Route::get('/agent/details/{id}', 'AgentDetails')->name('agent.details');
    // Send Message from Agent Details Page 
    Route::post('/agent/details/message',  'AgentDetailsMessage')->name('agent.details.message');
    // Get All Rent Property 
    Route::get('/sale/property', 'SaleProperty')->name('sale.property');
    // Get All Buy Property 
    Route::get('/rent/property', 'RentProperty')->name('rent.property');
    // Get All Property Type Data 
    Route::get('/property/type/{id}', 'PropertyType')->name('property.type');
    // Get State Details Data 
    Route::get('/state/details/{id}', [IndexController::class, 'StateDetails'])->name('state.details');

    // Home Page Buy Seach Option
    Route::post('/rent/property/search', [IndexController::class, 'PropertySeach'])->name('property.search');
    // All Property Seach Option
    Route::post('/all/property/search', [IndexController::class, 'AllPropertySeach'])->name('all.property.search');
    // Blog Details Route 
    Route::get('/blog/details/{slug}', [BlogController::class, 'BlogDetails']);
    // Blog by Category Details Route 
    Route::get('/blog/cat/list/{id}', [BlogController::class, 'BlogCatList']);
    // Blog show on Frontend Route 
    Route::get('/blog', [BlogController::class, 'BlogList'])->name('blog.list');
    // Blog Comment Route 
    Route::post('/store/comment', [BlogController::class, 'StoreComment'])->name('store.comment');

    // Schedule Message Request Route 
    Route::post('/store/schedule', [IndexController::class, 'StoreSchedule'])->name('store.schedule');
});
Route::controller(WishlistController::class)->group(function () {
    Route::post('/add-to-wishlist/{id}', 'AddToWishList')->name('add.to.wishlist');
    Route::get('/user/wishlist', 'UserWishlist')->name('user.wishlist');
    Route::get('/get-wishlist-property', 'GetWishlistProperty');
    Route::get('/wishlist-remove/{id}', 'WishlistRemove');
});

Route::controller(CompareController::class)->group(function () {
    Route::post('/add-to-compare/{id}', 'AddToCompare')->name('add.to.compare');
    Route::get('/user/compare', 'UserCompare')->name('user.compare');
    Route::get('/get-compare-property', 'GetCompareProperty');
    Route::get('/compare-remove/{id}', 'CompareRemove');
});