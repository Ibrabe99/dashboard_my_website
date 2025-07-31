<?php

use App\Http\Controllers\Admin\api\ApiAdminController;
use App\Http\Controllers\Admin\api\ApiArticlesController;
use App\Http\Controllers\Admin\api\ApiSkillsController;
use App\Http\Controllers\Admin\api\ApiProjectsController;
use App\Http\Controllers\Admin\api\ApiSocialLinkController;
use App\Http\Controllers\Admin\api\ContactMessageController;
use App\Http\Controllers\Admin\CVController;
use App\Http\Controllers\api\StatsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/hello', function (Request $request) {
    return response()->json(['message' => 'Hello, World!']);
});


Route::get('/admin/{name}', function (\App\Http\Requests\AdminRequest $request) {
    $name = $request->input('name');
});


Route::get('/admin', [ApiAdminController::class, 'show']);


Route::get('/social', [ApiSocialLinkController::class, 'index']);



Route::get('/skills', [ApiSkillsController::class, 'index']);
Route::get('/skills/{id}', [ApiSkillsController::class, 'show']);

Route::get('/projects', [ApiProjectsController::class, 'index']);
Route::get('/articles', [ApiArticlesController::class, 'index']);



Route::get('/projects/{id}', [ApiProjectsController::class, 'show']); // تفاصيل مشروع
Route::get('/articles/{id}', [ApiArticlesController::class, 'show']); // تفاصيل مقال


Route::post('/projects/{id}/stats', [ApiProjectsController::class, 'updateStats']);
Route::post('/articles/{id}/stats', [ApiArticlesController::class, 'updateStats']);




Route::post('/contact', [ContactMessageController::class, 'store']);



Route::post('/upload-cv', [CVController::class, 'upload']);

Route::get('/cv', [CVController::class, 'getCV']);

Route::get('/cv', function () {
    return response()->json([
        'url' => asset('storage/cvs/cv.pdf')
    ]);
});


Route::get('/download-cv', function () {
    $path = storage_path('app/public/storage/cvs/cv.pdf');

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->download($path, 'cv.pdf');
});

Route::post('/track-visit', [StatsController::class, 'trackVisit']);
Route::post('/update-stats/{type}/{id}', [StatsController::class, 'updateStats']);
