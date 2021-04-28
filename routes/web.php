<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $subcategories = Subcategory::latest()->get();
    $featuredproducts = Product::latest()->where('featured', 1)->get();
    $offerproducts = Product::latest()->where('discount', '>', 0)->take(6)->get();
    $filterproducts = Product::latest()->take(6)->get();
    return view('frontend.index', compact('subcategories', 'featuredproducts', 'offerproducts', 'filterproducts'));
})->name('index');

Route::get('/home', [FrontController::class, 'index'])->name('home');
Route::get('/shop', [FrontController::class, 'shop'])->name('shop');
Route::get('/contact', [FrontController::class, 'contact'])->name('contact');
Route::get('/products/{slug}', [FrontController::class, 'products'])->name('products');
Route::get('/checkout', [FrontController::class, 'checkout'])->name('checkout');
Route::get('/subcategory/{subcategoryslug}', [FrontController::class, 'subcategory'])->name('subcategory');

// Cart
Route::get('/cart', [FrontController::class, 'cart'])->name('cart');
Route::post('/addtocart/{id}', [FrontController::class, 'addtocart'])->name('addtocart');

// Wishlist
Route::get('/wishlist', [FrontController::class, 'wishlist'])->name('wishlist');
Route::get('/addtowishlist/{id}', [FrontController::class, 'addtowishlist'])->name('addtowishlist');
Route::get('/removefromwishlist/{id}', [FrontController::class, 'removefromwishlist'])->name('removefromwishlist');


Auth::routes();

Route::get('/verify',[RegisterController::class, 'verifyUser'])->name('verify.user');

 Route::group(['middleware' => ['auth']], function() {
    Route::resource('user', UserController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('subcategory', SubcategoryController::class);
    Route::resource('vendor', VendorController::class);
    Route::put('deleteproductimage/{id}', [ProductController::class, 'deleteproductimage'])->name('deleteproductimage');
    Route::post('addmoreproductimages/{id}', [ProductController::class, 'addmoreproductimages'])->name('addmoreproductimages');
    Route::resource('product', ProductController::class);
});




