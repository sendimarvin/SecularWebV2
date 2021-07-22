<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\QuestionController;
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

// Route::get('/', function () {
//     return view('layouts/app');
// });


Route::get('/', function () {
    return view('pages/dashboard');
});

Route::get('/nationality', [AddressController::class, 'getNationality']);

Route::get('/country', [AddressController::class, 'getCountries']);

Route::get('/region', [AddressController::class, 'getRegions']);

Route::get('/district', [AddressController::class, 'getDistricts']);

Route::get('/subcounty', [AddressController::class, 'getSubcounties']);

Route::get('/parish', [AddressController::class, 'getParishes']);

Route::get('/village', [AddressController::class, 'getVillages']);

Route::get('/users', [UserController::class, 'index']);

Route::get('/admins', [UserController::class, 'admins'])->name('admins');

Route::get('/admins/create', function () {
    return view('pages/create_admin');
})->name('admins.create');

Route::post('/admins/save', [UserController::class, 'create']);

Route::put('/admins/update/{id}', [UserController::class, 'update'])->name('/admins/update');

Route::get('/admins/delete/{id}', [UserController::class, 'destroy']);

Route::get('/admins/edit/{id}', [UserController::class, 'edit']);

// BEGON SECTION QUESTION CATEGORY ROUTES
Route::get('/question/categories', [QuestionController::class, 'categories'])->name('/question/categories');

Route::get('/question/new_category', function () {
    return view('pages/new_question_category');
})->name('/question/new_category');

Route::post('/question/save_category', [QuestionController::class, 'create_category']);

Route::get('/question/edit_category/{id}', [QuestionController::class, 'edit_category']);

Route::put('/question/update_category/{id}', [QuestionController::class, 'update_category'])->name('/question/update_category');

Route::get('/question/delete_category/{id}', [QuestionController::class, 'delete_category']);
// END SECTION QUESTION CATEGORY ROUTES


Route::get('/question/questions', [QuestionController::class, 'questions'])->name('/question/questions');

Route::get('/question/new_question',[QuestionController::class, 'new_question'])->name('/question/new_question');

Route::post('/question/save_question', [QuestionController::class, 'create_question']);

Route::get('/question/edit_question/{id}', [QuestionController::class, 'edit_question']);

Route::put('/question/update_question/{id}', [QuestionController::class, 'update_question'])->name('/question/update_question');

Route::get('/question/delete_question/{id}', [QuestionController::class, 'delete_question']);

//MAPPINGS

Route::get('/question/question_mappings', [QuestionController::class, 'question_mappings'])->name('/question/question_mappings');

Route::get('/question/new_question_mapping',[QuestionController::class, 'new_question_mapping'])->name('/question/new_question_mapping');

Route::post('/question/save_question_mapping', [QuestionController::class, 'create_question_mapping']);

Route::get('/question/edit_question_mapping/{id}', [QuestionController::class, 'edit_question_mapping']);

Route::put('/question/update_question_mapping/{id}', [QuestionController::class, 'update_question_mapping'])->name('/question/update_question_mapping');

Route::get('/question/delete_question_mapping/{id}', [QuestionController::class, 'delete_question_mapping']);

Route::get('/terms', [SettingController::class, 'terms'])->name('/terms');

Route::put('/update_terms/{id}', [SettingController::class, 'update_terms'])->name('/update_terms');

Route::get('/policy', [SettingController::class, 'policy'])->name('/policy');

Route::put('/update_policy/{id}', [SettingController::class, 'update_policy'])->name('/update_policy');