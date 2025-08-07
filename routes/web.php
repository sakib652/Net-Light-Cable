<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\ClientController;
use App\Http\Controllers\admin\DealerController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\AboutUsController;
use App\Http\Controllers\admin\AreaController;
use App\Http\Controllers\admin\CounterController;
use App\Http\Controllers\admin\GalleryController;
use App\Http\Controllers\admin\MessageController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ContactUsController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ManagementController;
use App\Http\Controllers\admin\CertificateController;
use App\Http\Controllers\frontend\FacilitiesController;
use App\Http\Controllers\admin\AuthenticationController;
use App\Http\Controllers\frontend\FrontProductController;

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

Route::get('/', [HomeController::class, 'home'])->name('home');

// About us
Route::get('/about', [AboutUsController::class, 'view'])->name('front.about.view');

// Certificate
Route::get('/certificates', [CertificateController::class, 'view'])->name('front.certificate.view');

// Dealers
Route::get('/dealers', [DealerController::class, 'view'])->name('front.dealer.view');

// Gallery
Route::get('/photo-gallery', [GalleryController::class, 'photoGallery'])->name('gallery.photo');
Route::get('/video-gallery', [GalleryController::class, 'videoGallery'])->name('gallery.video');

// Our Team
Route::get('/our-team', [ManagementController::class, 'view'])->name('front.team.view');

// Facilities
Route::get('/facilities', [FacilitiesController::class, 'view'])->name('front.facilities.view');

//Products & Client wise product show
Route::get('/product-list', [FrontProductController::class, 'productList'])->name('product.productList');
Route::get('/product/{slug}', [FrontProductController::class, 'showClientWiseProduct'])->name('client.show');
Route::get('/show/{slug}', [FrontProductController::class, 'show'])->name('product.show');

// Route::get('/search/products', [FrontProductController::class, 'searchProduct'])->name('products.search');
// Route::get('/categories/all', [FrontProductController::class, 'showAll'])->name('categories.all');
// Route::get('/product/quick/view/{slug}', [FrontProductController::class, 'quickView'])->name('product.quickView');

// Contact Us
Route::get('/contact-form', [ContactUsController::class, 'create'])->name('front.contact.create');
Route::post('/contact-submit', [ContactUsController::class, 'contactSubmit'])->name('contact.submit');

// Authentication
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthenticationController::class, 'showLogin'])->name('admin');
    Route::post('/login', [AuthenticationController::class, 'loginCheck'])->name('admin.login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');

    // Update Profile
    Route::get('/profile', [AuthenticationController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [AuthenticationController::class, 'updateProfile'])->name('profile.update');

    // Change Password
    Route::get('/change-password', [AuthenticationController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [AuthenticationController::class, 'updatePassword'])->name('password.update');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::put('/users/update-status/{id}', [UserController::class, 'updateStatus'])->name('users.updateStatus');
    Route::delete('/users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // sliders
    Route::get('/sliders', [SliderController::class, 'index'])->name('sliders.index');
    Route::get('/sliders/create', [SliderController::class, 'create'])->name('sliders.create');
    Route::post('/sliders/store', [SliderController::class, 'store'])->name('sliders.store');
    Route::get('/sliders/edit/{id}', [SliderController::class, 'edit'])->name('sliders.edit');
    Route::put('/sliders/update/{id}', [SliderController::class, 'update'])->name('sliders.update');
    Route::put('/sliders/update-status/{id}', [SliderController::class, 'updateStatus'])->name('sliders.updateStatus');
    Route::delete('/sliders/destroy/{id}', [SliderController::class, 'destroy'])->name('sliders.destroy');

    // Client
    Route::get('/client', [ClientController::class, 'index'])->name('client.index');
    Route::get('/client/create', [ClientController::class, 'create'])->name('client.create');
    Route::post('/client/store', [ClientController::class, 'store'])->name('client.store');
    Route::get('/client/edit/{id}', [ClientController::class, 'edit'])->name('client.edit');
    Route::put('/client/update/{id}', [ClientController::class, 'update'])->name('client.update');
    Route::put('/client/update-status/{id}', [ClientController::class, 'updateStatus'])->name('client.updateStatus');
    Route::delete('/client/destroy/{id}', [ClientController::class, 'destroy'])->name('client.destroy');

    // Dealer
    Route::get('/dealer', [DealerController::class, 'index'])->name('dealer.index');
    Route::get('/dealer/create', [DealerController::class, 'create'])->name('dealer.create');
    Route::post('/dealer/store', [DealerController::class, 'store'])->name('dealer.store');
    Route::get('/dealer/edit/{id}', [DealerController::class, 'edit'])->name('dealer.edit');
    Route::put('/dealer/update/{id}', [DealerController::class, 'update'])->name('dealer.update');
    Route::put('/dealer/update-status/{id}', [DealerController::class, 'updateStatus'])->name('dealer.updateStatus');
    Route::delete('/dealer/destroy/{id}', [DealerController::class, 'destroy'])->name('dealer.destroy');

    // Area
    Route::get('/areas', [AreaController::class, 'index'])->name('areas.index');
    Route::get('/areas/create', [AreaController::class, 'create'])->name('areas.create');
    Route::post('/areas/store', [AreaController::class, 'store'])->name('areas.store');
    Route::get('/areas/edit/{id}', [AreaController::class, 'edit'])->name('areas.edit');
    Route::put('/areas/update/{id}', [AreaController::class, 'update'])->name('areas.update');
    Route::put('/areas/update-status/{id}', [AreaController::class, 'updateStatus'])->name('areas.updateStatus');
    Route::delete('/areas/destroy/{id}', [AreaController::class, 'destroy'])->name('areas.destroy');


    // About-us
    Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us.index');
    Route::put('/about-us/update', [AboutUsController::class, 'update'])->name('about-us.update');

    // Chairman Message
    Route::get('/message', [MessageController::class, 'index'])->name('message.index');
    Route::put('/message/update', [MessageController::class, 'update'])->name('message.update');

    // counters
    Route::get('/counters/create', [CounterController::class, 'create'])->name('counters.create');
    Route::post('/counters/store', [CounterController::class, 'store'])->name('counters.store');
    Route::get('/counters/edit/{id}', [CounterController::class, 'edit'])->name('counters.edit');
    Route::put('/counters/update/{id}', [CounterController::class, 'update'])->name('counters.update');
    Route::put('/counters/update-status/{id}', [CounterController::class, 'updateStatus'])->name('counters.updateStatus');
    Route::delete('/counters/destroy/{id}', [CounterController::class, 'destroy'])->name('counters.destroy');

    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::put('/categories/update-status/{id}', [CategoryController::class, 'updateStatus'])->name('categories.updateStatus');
    Route::delete('/categories/destroy/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::put('/products/update-status/{id}', [ProductController::class, 'updateStatus'])->name('products.updateStatus');
    Route::delete('/products/destroy/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Certificate
    Route::get('/certificate', [CertificateController::class, 'index'])->name('certificate.index');
    Route::get('/certificate/create', [CertificateController::class, 'create'])->name('certificate.create');
    Route::post('/certificate/store', [CertificateController::class, 'store'])->name('certificate.store');
    Route::get('/certificate/edit/{id}', [CertificateController::class, 'edit'])->name('certificate.edit');
    Route::put('/certificate/update/{id}', [CertificateController::class, 'update'])->name('certificate.update');
    Route::put('/certificate/update-status/{id}', [CertificateController::class, 'updateStatus'])->name('certificate.updateStatus');
    Route::delete('/certificate/destroy/{id}', [CertificateController::class, 'destroy'])->name('certificate.destroy');

    // Management
    Route::get('/management', [ManagementController::class, 'index'])->name('management.index');
    Route::get('/management/create', [ManagementController::class, 'create'])->name('management.create');
    Route::post('/management/store', [ManagementController::class, 'store'])->name('management.store');
    Route::get('/management/edit/{id}', [ManagementController::class, 'edit'])->name('management.edit');
    Route::put('/management/update/{id}', [ManagementController::class, 'update'])->name('management.update');
    Route::put('/management/update-status/{id}', [ManagementController::class, 'updateStatus'])->name('management.updateStatus');
    Route::delete('/management/destroy/{id}', [ManagementController::class, 'destroy'])->name('management.destroy');

    // Gallery
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::get('/gallery/create', [GalleryController::class, 'create'])->name('gallery.create');
    Route::post('/gallery/store', [GalleryController::class, 'store'])->name('gallery.store');
    Route::get('/gallery/edit/{id}', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::put('/gallery/update-status/{id}', [GalleryController::class, 'updateStatus'])->name('gallery.updateStatus');
    Route::put('/gallery/update/{id}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/destroy/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    // Contact-us
    Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contact-us.index');
    Route::delete('/contact-us/{id}', [ContactUsController::class, 'destroy'])->name('contact-us.destroy');

    // settings
    Route::get('/setting', [SettingController::class, 'setting'])->name('setting');
    Route::put('/setting', [SettingController::class, 'update'])->name('setting.update');
});
