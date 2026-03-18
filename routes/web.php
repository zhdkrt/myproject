<?php

use App\Http\Controllers\VacancyController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CategoryController;

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/',[VacancyController::class, 'index'])->name('index');
Route::get('/vacancies/{vacancy}', [VacancyController::class, 'show'])->name('show');

Route::get('/companies', [CompanyController::class, 'index'])->name('companiesIndex');
Route::get('/companies/{company}', [CompanyController::class, 'show'])->name('companyShow');

Route::get('/categories',[CategoryController::class, 'index'])->name('categoriesIndex');
Route::get('categories/{category}',[CategoryController::class, 'show'])->name('categoriesShow');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
