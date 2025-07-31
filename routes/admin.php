<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Api\ContactMessageController;
use App\Http\Controllers\Admin\CVController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectsController;
use App\Http\Controllers\Admin\ArticlesController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\SkillsController;

// Route::get('/', function () {
//     return view('welcome');
// });



Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');
        Route::get('log', [LoginController::class, 'get'])->name('admin.log');


        /***********           Start profile Rout              ***********/

        Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::post('/admin/profile/update', [AdminController::class, 'update'])->name('admin.profile.update');


        /***********           End  profile  Rout              ***********/



        /***********           Start social-links Rout              ***********/

        Route::get('/social-links', [SocialLinkController::class, 'edit'])->name('social-links.edit');
        Route::post('admin/social-links', [SocialLinkController::class, 'update'])->name('admin.social-links.update');
        /***********           End  social-links  Rout              ***********/



        /***********           Start skills Rout              ***********/

        Route::get('/skills', [SkillsController::class, 'index'])->name('skills.index');
        Route::post('/skills', [SkillsController::class, 'store'])->name('skills.store');
        Route::put('/skills/{skill}', [SkillsController::class, 'update'])->name('skills.update');
        Route::delete('/skills/{skill}', [SkillsController::class, 'destroy'])->name('skills.destroy');
        Route::post('/skills/{skill}/toggle', [SkillsController::class, 'toggle'])->name('skills.toggle');

        /***********           End  skills  Rout              ***********/



        /***********           Start Projects Rout              ***********/

        Route::get('projects', [ProjectsController::class, 'index'])->name('admin.projects');


        /** Creat **/
        Route::get('projects/create', [ProjectsController::class, 'create'])->name('admin.projects.create');
        Route::post('projects', [ProjectsController::class, 'store'])->name('admin.projects.store');

        /** Edit **/
        Route::get('projects/{id}/edit', [ProjectsController::class, 'edit'])->name('admin.projects.edit');
        Route::put('projects/{project}', [ProjectsController::class, 'update'])->name('admin.projects.update');


        Route::get('projects/{id}', [ProjectsController::class, 'toggleStatus'])->name('admin.projects.active');

        Route::get('projects/{id}/show', [ProjectsController::class, 'show'])->name('admin.projects.show');
        /** Delete **/
        Route::delete('admin/projects/{project}', [ProjectsController::class, 'destroy'])->name('admin.projects.destroy');



        /***********           End  Projects  Rout              ***********/



        /***********           Start Articles Rout              ***********/

        Route::get('articles', [ArticlesController::class, 'index'])->name('admin.articles');


        /** Creat **/
        Route::get('articles/create', [ArticlesController::class, 'create'])->name('admin.articles.create');
        Route::post('articles', [ArticlesController::class, 'store'])->name('admin.articles.store');

        /** Edit **/
        Route::get('articles/{id}/edit', [ArticlesController::class, 'edit'])->name('admin.articles.edit');
        Route::put('articles/{article}', [ArticlesController::class, 'update'])->name('admin.articles.update');


        Route::get('articles/{id}', [ArticlesController::class, 'toggleStatus'])->name('admin.articles.active');

        Route::get('articles/{id}/show', [ArticlesController::class, 'show'])->name('admin.articles.show');
        /** Delete **/
        Route::delete('articles/{id}', [ArticlesController::class, 'destroy'])->name('admin.articles.destroy');


        /***********           End  Articles  Rout              ***********/



        /***********           Start Category Rout              ***********/

        Route::get('category', [CategoryController::class, 'index'])->name('admin.category');


        /** Creat **/
        Route::get('category/create', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::post('category', [CategoryController::class, 'store'])->name('admin.category.store');

        /** Edit **/
        Route::get('category/{id}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::put('category/{id}', [CategoryController::class, 'update'])->name('admin.category.update');

        Route::get('category/{id}', [CategoryController::class, 'toggleStatus'])->name('admin.category.active');
        /** Delete **/
        Route::delete('category/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');


        /***********           End  Category  Rout              ***********/





    /***********           Start  CV  Rout              ***********/

    // في routes/web.php
    Route::get('/download-cv/{filename}', function ($filename) {
        $path = storage_path('app/public/cvs/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->download($path);
    });

    Route::get('/upload-cv', function () {
        return view('upload_cv');
    });

    Route::post('/upload-cv', [CVController::class, 'upload'])->name('cv.upload');

    /***********           End  CV  Rout              ***********/





    /***********           Start  Messages  Rout              ***********/

    Route::get('/messages', [ContactMessageController::class, 'showMessages'])->name('messages.show');

    /***********           End  Messages  Rout              ***********/

});


Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
        Route::get('login', [LoginController::class, 'getlogin'])->name('login');
        Route::post('login', [LoginController::class, 'login'])->name('admin.login');
});




Route::fallback(function () {
    return redirect()->route('admin.login');
});

