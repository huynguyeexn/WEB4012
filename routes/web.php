<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\GithubController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\Pages\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;
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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// require __DIR__.'/auth.php';

// <-- AUTHENTICATION --> //
Route::prefix('auth')->group(function () {
    // GOOGLE LOGIN
    Route::prefix('google')->group(function () {
        Route::get('/', [GoogleController::class, 'login'])->name('login.google');
        Route::get('callback', [GoogleController::class, 'callback']);
    });

    // GITHUB LOGIN
    Route::prefix('github')->group(function () {
        Route::get('/', [GithubController::class, 'login'])->name('login.github');
        Route::get('callback', [GithubController::class, 'callback']);
    });
});
Route::get('login', [PageController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('toLogin');
Route::get('register', [PageController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('toRegister');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


/**
 *
 *
 *
 */
// <-- TRANG CHỦ --> //
Route::redirect('/', '/trang-chu', 301);
Route::get('/trang-chu', [PageController::class, 'index'])->name('home');

// <-- BÀI VIẾT --> //
Route::get('bai-viet/{slug}', [PageController::class, 'post'])->name('post');
Route::post('bai-viet/{slug}', [CommentController::class, 'store'])->name('commentPost')->middleware(ProtectAgainstSpam::class);

// <-- THẺ --> //
Route::get('tag/{slug}', [PageController::class, 'tag'])->name('tag');

// <-- CHUYÊN MỤC --> //
Route::get('chuyen-muc/{parent}/{child?}', [PageController::class, 'category'])->name('category');
Route::get('search', [PostController::class, 'search'])->name('search');

// <-- LIÊN HỆ --> //
Route::get('lien-he', [PageController::class, 'contact'])->name('contact');
Route::post('lien-he', [PageController::class, 'sendContact'])->name('sendContact');

// <-- BÁO CÁO --> //
Route::get('bao-cao', function () {
    return view('pages.site.baocao');
})->name('baocao');

/**
 *
 *
 *
 */
// <-- ADMIN --> //
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin', 'auth']], function () {
    // Dashboard
    Route::get('/', function () {
        return view("pages.admin.dashboard");
    })->name('dashboard');

    // Categories
    Route::resource('categories', CategoryController::class)->except(['show']);
    // Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
    //     Route::get('/deleted', [CategoryController::class, 'deleted'])->name('deleted');
    //     Route::get('{id}/restore', [CategoryController::class, 'restore'])->name('restore');
    //     Route::delete('{id}/remove', [CategoryController::class, 'remove'])->name('remove');
    // });

    //Posts
    Route::resource('posts', PostController::class)->except(['show']);
    Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {
        Route::get('/deleted', [PostController::class, 'deleted'])->name('deleted');
        Route::get('{id}/restore', [PostController::class, 'restore'])->name('restore');
        Route::delete('{id}/remove', [PostController::class, 'remove'])->name('remove');
    });


    // Tags
    Route::resource('tags', TagController::class)->except(['show']);
    Route::group(['prefix' => 'tags', 'as' => 'tags.'], function () {
        Route::get('/deleted', [TagController::class, 'deleted'])->name('deleted');
        Route::get('{id}/restore', [TagController::class, 'restore'])->name('restore');
        Route::delete('{id}/remove', [TagController::class, 'remove'])->name('remove');
    });

    // Comments
    Route::resource('comments', CommentController::class)->except(['show', 'store', 'create', 'edit', 'update']);
    Route::group(['prefix' => 'comments', 'as' => 'comments.'], function () {
        Route::get('/deleted', [CommentController::class, 'deleted'])->name('deleted');
        Route::get('{id}/restore', [CommentController::class, 'restore'])->name('restore');
        Route::delete('{id}/remove', [CommentController::class, 'remove'])->name('remove');
    });

    // Tags
    Route::resource('users', UserController::class)->except(['show']);
    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/deleted', [UserController::class, 'deleted'])->name('deleted');
        Route::get('{id}/restore', [UserController::class, 'restore'])->name('restore');
        Route::delete('{id}/remove', [UserController::class, 'remove'])->name('remove');
    });
});


Route::get('resizes/{size}/{imagePath}', [ImageController::class, 'flyResize'])->where('imagePath', '(.*)')->name('resizes');
