<?php

use App\Http\Controllers\frontend\AboutController as frontAboutController;
use App\Http\Controllers\backend\AboutController;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\frontend\ContactController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\SettingMidllware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\UserController;
use App\Models\User;
use App\Models\Profile;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Models\Role;


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

Route::middleware('setting')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/posts/{slug}', [HomeController::class, 'show'])->name('home.show');
    Route::get('/about', [frontAboutController::class, 'index'])->name('about');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactController::class, 'send'])->name('send');

    Route::get('test', function () {
        // $post = DB::table('posts')
        // ->join('profiles','posts.profile_id','profiles.id')
        // ->join('users','profiles.user_id','users.id')
        // ->select('posts.title as PostTitle','profiles.profile as PostProfile','users.name','users.email')
        // ->get();

        // ->rightJoin('profiles','posts.profile_id','profiles.id')
        // ->select('posts.*','profiles.id as profile Id')
        // ->get();
        // dd($post);


        // return User::find(6)->roles;
        // return Role::find(1)->users;


    });
});
// This route handles the language switching logic
Route::get('lang/{locale}', function ($locale) {
    // Only allow 'en' (English) and 'dr' (Dari) as valid locales
    if (in_array($locale, ['en', 'dr'])) {
        // Store the chosen language in the session
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('locale');






Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('backend.dashboard.index');
    })->name('dashboard');

    Route::resource('post', PostController::class);
    Route::get('trash', [PostController::class, 'trash'])->name('post.trash');
    Route::get('restore/{id}', [PostController::class, 'restore'])->name('post.restore');
    Route::delete('force-delete/{id}', [PostController::class, 'delete'])->name('post.delete');


    Route::get('admin/about', [AboutController::class, 'index'])->name('about.index');
    Route::post('admin/about', [AboutController::class, 'store'])->name('about.store');

    Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
    Route::post('setting', [SettingController::class, 'store'])->name('setting.store');

    
    // / Index route only requires user view permission
    Route::get('user', [UserController::class, 'index'])->name('user.index')->middleware('permission:user view');
    // Create route requires user create permission
    Route::get('user/create', [UserController::class, 'create'])->name('user.create')->middleware('permission:user create');
    // Store route requires user create permission
    Route::post('user/store', [UserController::class, 'store'])->name('user.store')->middleware('permission:user create');




    Route::resource('role', RoleController::class);
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
