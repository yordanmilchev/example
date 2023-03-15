<?php

use App\Http\Controllers\Admin\ActivitiesController;
use App\Http\Controllers\Admin\AddRouteKeyController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogArticleController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\Catalog\AttributeController;
use App\Http\Controllers\Admin\Catalog\ProductCategoryController;
use App\Http\Controllers\Admin\Catalog\ProductController;
use App\Http\Controllers\Admin\Catalog\ProductModelController;
use App\Http\Controllers\Admin\Catalog\ProductWeightController;
use App\Http\Controllers\Admin\CitiesController;
use App\Http\Controllers\Admin\ContactsController;
use App\Http\Controllers\Admin\DataChecks\ActivityChecksController;
use App\Http\Controllers\Admin\DataChecks\BlogArticleChecksController;
use App\Http\Controllers\Admin\DataChecks\ProductChecksController;
use App\Http\Controllers\Admin\Feedback\OrderFeedbacksController;
use App\Http\Controllers\Admin\GalleryImageController;
use App\Http\Controllers\Admin\HomepageContentController;
use App\Http\Controllers\Admin\LayoutBlockController;
use App\Http\Controllers\Admin\NeighbourhoodController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\Reports\ReportBoricaTransactionsController;
use App\Http\Controllers\Admin\Reports\ReportByPriceTypeController;
use App\Http\Controllers\Admin\Reports\ReportByRegionController;
use App\Http\Controllers\Admin\Reports\ReportBySourceController;
use App\Http\Controllers\Admin\Reports\ReportMyPosTransactionsController;
use App\Http\Controllers\Admin\Reports\ReportSalesByCityOrRegionController;
use App\Http\Controllers\Admin\Reports\ReportSalesByDayAndSourceController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\Settings\CacheController;
use App\Http\Controllers\Admin\Settings\ImpressionateController;
use App\Http\Controllers\Admin\Settings\SettingsController;
use App\Http\Controllers\Admin\SpeedyShipmentController;
use App\Http\Controllers\Admin\StoresController;
use App\Http\Controllers\Admin\UrlMetaController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::name("admin.")->middleware(['admin.auth'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::name('user.')->prefix('/user')->middleware('can:view_users')->group(function () {
        Route::get('/list', [UserController::class, 'index'])->name('list');
        Route::any('/list-edit/{id?}', [UserController::class, 'edit'])->name('list-edit');
        Route::get('/summary/{user}', [UserController::class, 'summary'])->name('summary')->middleware('can:manage_system');
    });

    Route::get('/role/list', [RoleController::class, 'index'])->middleware('can:manage_acl')->name('role.list');

    Route::name('homepage.')->prefix('/homepage')->middleware('can:manage_homepage')->group(function () {
        Route::get('/slider/list', [HomepageContentController::class, 'sliderList'])->name('slider.list');
        Route::any('/slider/edit', [HomepageContentController::class, 'sliderEdit'])->name('slider.edit');
        Route::any('/partners', [HomepageContentController::class, 'partners'])->name('partners');
        Route::any('/file/upload', [HomepageContentController::class, 'uploadFile'])->name('file.upload');
        Route::post('/partners/save', [HomepageContentController::class, 'savePartners'])->name('partners.save');
    });

    Route::name('slider.')->prefix('/slider')->middleware('can:manage_homepage_slider')->group(function () {
        Route::get('/list', [HomepageContentController::class, 'index'])->name('list');
        Route::any('/edit', [HomepageContentController::class, 'edit'])->name('edit');
    });

    Route::name('activity.')->prefix('/activity')->middleware('can:manage_activities')->group(function () {
        Route::get('/list', [ActivitiesController::class, 'index'])->name('list');
        Route::any('/edit', [ActivitiesController::class, 'edit'])->name('edit');
    });

    Route::name('service.')->prefix('/service')->middleware('can:manage_services')->group(function () {
        Route::get('/list', [ServiceController::class, 'index'])->name('list');
        Route::any('/edit', [ServiceController::class, 'edit'])->name('edit');
    });

    Route::name('gallery.')->prefix('/gallery')->middleware('can:manage_gallery')->group(function () {
        Route::get('/', [GalleryImageController::class, 'index'])->name('index');
        Route::any('/edit', [GalleryImageController::class, 'edit'])->name('edit');
        Route::any('/file/upload', [GalleryImageController::class, 'uploadFile'])->name('file.upload');
        Route::any('/gallery-categories/save-tree', [GalleryImageController::class, 'saveCategoryTree'])->name('gallery_categories.save');
    });

    Route::get('/message', [ContactsController::class, 'index'])->name('message.index')->middleware('can:manage_inquiries');

    Route::post('/key', [AddRouteKeyController::class, 'addKey'])->name('add_key');

    Route::any('/impressionate', [ImpressionateController::class, 'index'])->name('impressionate'); //has permission manage_system in the controller

    Route::any('/cache', [CacheController::class, 'index'])->name('cache')->middleware('can:manage_system');

    Route::resource('pages', PagesController::class)->middleware('can:manage_pages'); // names are automatically generated

    Route::resource('settings', SettingsController::class)->middleware('can:manage_system'); // names are automatically generated

    Route::resource('layout-blocks', LayoutBlockController::class)->middleware('can:manage_layout_blocks'); // names are automatically generated

    Route::name('blog.')->prefix('/blog')->middleware('can:manage_blog')->group(function () {
        Route::get('/article/list', [BlogArticleController::class, 'index'])->name('article.list');
        Route::any('/article/edit', [BlogArticleController::class, 'edit'])->name('article.edit');
        Route::get('/categories/list', [BlogCategoryController::class, 'index'])->name('categories.list');
        Route::any('/categories/edit', [BlogCategoryController::class, 'edit'])->name('categories.edit');
    });

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs');

    Route::name('url_metas.')->prefix('/url_metas')->group(function () {
        Route::get('/list', [UrlMetaController::class, 'index'])->name('list');
        Route::any('/edit', [UrlMetaController::class, 'edit'])->name('edit');
        Route::delete('/destroy/{id?}', [UrlMetaController::class, 'destroy'])->name('destroy');
    });
});
