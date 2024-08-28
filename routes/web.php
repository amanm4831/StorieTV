<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminUserController;



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
//     return view('welcome');
// });

Route::get('reset', function (){
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
});

//Admin 
Route::get('/', [AdminController::class, 'adminLogin'])->name('admin-login');
// Route::get('/admin', [AdminUserController::class, 'index'])->name('admin.index');  
Route::get('/forget-password',[AdminController::class,'forgetPassword'])->name('forget-pswd');
// Route::get('/admin-sub', [AdminUserController::class, 'subadmin'])->name('subadmin');
// Route::get('/admin', [AdminUserController::class, 'index'])->name('admin.index'); 
Route::get('/otp',[AdminController::class,'checkOtp'])->name('otp');
Route::get('/reset-password',[AdminController::class,'resetPassword'])->name('reset-password');
Route::post('/authentication',[AdminController::class,'authenticateAdmin']);
Route::get('/validate-email',[AdminController::class,'forgetPasswordwithEmail'])->name('validate-email');
Route::post('/verify-otp',[AdminController::class,'verifyOtp']);
Route::post('/reset-pswd',[AdminController::class,'resetPswd']);

// Protect admin routes
Route::group(['middleware' => 'role:N'], function () {
    // Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/admin-sub', [AdminUserController::class, 'subadmin'])->name('subadmin');
    Route::get('/admin', [AdminUserController::class, 'index'])->name('admin.index'); 
    Route::post('/users/block/{id}', [UserController::class, 'block'])->name('users.block');
    Route::get('/users/details/{id}', [UserController::class, 'details'])->name('user.details');
    Route::get('/user-stats', [UserController::class, 'userStats'])->name('user.stats');
    Route::get('users/{userId}/followers', [UserController::class, 'getFollowers']);
    Route::get('users/{userId}/following', [UserController::class, 'getFollowing']);
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users_detail/{id}', [UserController::class, 'details'])->name('users.show');
    Route::post('/users', [UserController::class, 'userSearch'])->name('user.search');
    Route::get('/blogs', function () {
        return view('Blogs.blogs');
    })->name('blogs');
    Route::get('/blog-form', [UserController::class, 'blogPost']);
    Route::get('/editor', [EditorController::class, 'show'])->name('editor');
    Route::get('/check-page', [UserController::class, 'checkPage']);
    Route::get('/event-form', [UserController::class, 'event']);
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs-store', [BlogController::class, 'create'])->name('blogs.store');
});

Route::get('/users', [UserController::class, 'index'])->name('users');

Route::group(['middleware' => 'role:S'], function () {
    Route::get('/admin', [AdminUserController::class, 'index'])->name('admin.index'); 
    
    Route::post('/users/block/{id}', [UserController::class, 'block'])->name('users.block');
    Route::get('/users/details/{id}', [UserController::class, 'details'])->name('user.details');
    Route::get('/user-stats', [UserController::class, 'userStats'])->name('user.stats');
    Route::get('users/{userId}/followers', [UserController::class, 'getFollowers']);
    Route::get('users/{userId}/following', [UserController::class, 'getFollowing']);
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users_detail/{id}', [UserController::class, 'details'])->name('users.show');
    Route::post('/users', [UserController::class, 'userSearch'])->name('user.search');
    Route::get('/blogs', function () {
        return view('Blogs.blogs');
    })->name('blogs');
    Route::get('/blog-form', [UserController::class, 'blogPost']);
    Route::get('/editor', [EditorController::class, 'show'])->name('editor');
    Route::get('/check-page', [UserController::class, 'checkPage']);
    Route::get('/event-form', [UserController::class, 'event']);
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs-store', [BlogController::class, 'create'])->name('blogs.store');
    Route::get('/event', function () {
        return view('Event.event_response');
    })->name('event');
    Route::get('/pending', [BlogController::class, 'pendingBlogs'])->name('pending.blogs');
});


// Route::get('/users',[UserController::class,'index'])->name('users');
// Route::post('/users/block/{id}', [UserController::class, 'block'])->name('users.block');

// // Route::get('/users/details/{id}', [UserController::class, 'details'])->name('user.details');

// Route::get('/user-stats', [UserController::class, 'userStats'])->name('user.stats');

// Route::get('users/{userId}/followers', [UserController::class, 'getFollowers']);

// Route::get('users/{userId}/following', [UserController::class, 'getFollowing']);

// Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');


// Route::get('/users_detail/{id}', [UserController::class, 'details'])->name('users.show');

// Route::post('/users', [UserController::class,'userSearch'])->name('user.search');


// Route::get('/blogs', function () {
//     return view('Blogs.blogs');
// })->name('blogs');

Route::get('/blog-form', [UserController::class,'blogPost']);

Route::get('/editor', [EditorController::class, 'show'])->name('editor');

Route::get('/test', function () {
    return view('test');
});

Route::get('check-page',[UserController::class,'checkPage']);

Route::get('/event', function (){
    return view('Event.event_response');
})->name('event');;

Route::get('/event-form', [UserController::class,'event']);

// Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
// Route::post('/blogs-store', [BlogController::class, 'store'])->name('blogs.store');
// Route::post('/blogs-store', [BlogController::class, 'create'])->middleware('auth')->name('blogs.store');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/blogs', [BlogController::class, 'blogsDetails'])->name('blogs');

Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
// Route::post('/blogs-store', [BlogController::class, 'store'])->name('blogs.store');
Route::post('/blogs-store', [BlogController::class, 'store'])->name('blogs.store');

Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');


Route::put('/blogs/{id}/edit', [BlogController::class, 'update'])->name('blogs.update');

Route::get('/blog-show/{id}', [BlogController::class, 'blogCardShow']);

Route::get('/approve/{id}', [BlogController::class, 'approve'])->name('blogs.approve');
Route::get('/reject/{id}', [BlogController::class, 'reject'])->name('blogs.reject');


// Route::get('/users', [AdminUserController::class, 'index'])->name('users');












