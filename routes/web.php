<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\GalleryCategoryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\GalleryImageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OfficeController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about-us', [PageController::class, 'about'])->name('about');
Route::get('/contact-us', [PageController::class, 'contact'])->name('contact');
Route::post('/contact-us', [PageController::class, 'submitContact'])->name('contact.submit');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/brands', [PageController::class, 'brands'])->name('brands');
Route::get('/offices', [OfficeController::class, 'index'])->name('offices');
Route::get('/api/offices/city/{city}', [OfficeController::class, 'getOfficesByCity'])->name('offices.by-city');
Route::get('/api/offices/{id}', [OfficeController::class, 'getOfficeDetails'])->name('offices.details');

Route::group(['middleware' => ['auth']], function () {

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::resource('roles', RoleController::class)->except(['show']);
        Route::resource('permissions', PermissionController::class)->except(['show']);
        Route::resource('users', UserController::class);
        Route::resource('brands', BrandController::class);
        Route::resource('teams', TeamController::class)->except(['show']);
        Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);
        Route::post('contacts/{contact}/toggle-read', [ContactController::class, 'toggleRead'])->name('contacts.toggle-read');

        // Gallery Categories
        Route::resource('gallery-categories', GalleryCategoryController::class)->except(['show']);

        // Galleries
        Route::resource('galleries', GalleryController::class)->except(['show']);

        // Gallery Images
        Route::group(['prefix' => 'galleries/{gallery}/images', 'as' => 'galleries.images.'], function () {
            Route::get('/', [GalleryImageController::class, 'index'])->name('index');
            Route::get('/create', [GalleryImageController::class, 'create'])->name('create');
            Route::post('/', [GalleryImageController::class, 'store'])->name('store');
            Route::get('/{image}/edit', [GalleryImageController::class, 'edit'])->name('edit');
            Route::put('/{image}', [GalleryImageController::class, 'update'])->name('update');
            Route::delete('/{image}', [GalleryImageController::class, 'destroy'])->name('destroy');
            Route::post('/reorder', [GalleryImageController::class, 'reorder'])->name('reorder');
        });
    });

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__ . '/auth.php';
