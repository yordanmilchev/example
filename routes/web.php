<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\AutocompleteController;
use App\Http\Controllers\BlogArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GalleryImagesController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\OrderFeedbackController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\SwitchlangController;
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

Route::get('/', [HomepageController::class, 'show'])->name('homepage');

Route::get('/service/{slug}', [HomepageController::class, 'showService'])->name('service');

Route::get('/activity/{slug}', [HomepageController::class, 'showActivity'])->name('activity');

Route::get('/switchlang/{locale}', [SwitchlangController::class, 'index'])->name('switchlang');

Route::name("account.")->prefix('account')->group(function () {
    Route::delete('/anonymize', [AccountController::class, 'anonymize'])->name('anonymize');
});

Route::name("blog.")->prefix('blog')->group(function () {
    Route::get('/', [BlogArticleController::class, 'listAllArticles'])->name('all_articles');
    Route::get('/{categorySlug}', [BlogArticleController::class, 'index'])->name('articles_list');
    Route::get('/article/{article}', [BlogArticleController::class, 'show'])->name('article');
    Route::get('/article/date/{date}', [BlogArticleController::class, 'showByDate'])->name('article.date');
});

Route::get('/page/{slug}', [PageController::class, 'show'])->name('page');

Route::name("contacts.")->prefix('contacts')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::post('/save', [ContactController::class, 'save'])->name('save');
});

Route::get('/gallery', [GalleryImagesController::class, 'index'])->name('gallery');

Route::get('/autocomplete/{datasetName}', [AutocompleteController::class, 'index'])->name('autocomplete');

require __DIR__ . '/auth.php';
