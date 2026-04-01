<?php

use App\Http\Controllers\VacancyController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CabinetController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\EmployerVacancyController;
use App\Http\Controllers\FavoriteController;

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

Route::get('/cabinet', [CabinetController::class, 'index'])->name('cabinet.index');
Route::get('/cabinet/edit', [CabinetController::class, 'edit'])->middleware('auth')->name('cabinet.edit');
Route::put('/cabinet/edit', [CabinetController::class, 'update'])->middleware('auth')->name('cabinet.update');

Route::get('/cabinet/resume', [ResumeController::class, 'index'])->middleware('auth')->name('cabinet.resume');
Route::get('/cabinet/resume/create', [ResumeController::class, 'create'])->middleware('auth')->name('cabinet.resume.create');
Route::post('/cabinet/resume', [ResumeController::class, 'store'])->middleware('auth')->name('cabinet.resume.store');
Route::get('/cabinet/resume/{resume}/edit', [ResumeController::class, 'edit'])->middleware('auth')->name('cabinet.resume.edit');
Route::put('/cabinet/resume/{resume}', [ResumeController::class, 'update'])->middleware('auth')->name('cabinet.resume.update');
Route::delete('/cabinet/resume/{resume}', [ResumeController::class, 'destroy'])->middleware('auth')->name('cabinet.resume.destroy');

Route::get('/cabinet/vacancies', [EmployerVacancyController::class, 'index'])->middleware('auth')->name('cabinet.vacancies');
Route::get('/cabinet/vacancies/create', [EmployerVacancyController::class, 'create'])->middleware('auth')->name('cabinet.vacancies.create');
Route::post('/cabinet/vacancies', [EmployerVacancyController::class, 'store'])->middleware('auth')->name('cabinet.vacancies.store');
Route::get('/cabinet/vacancies/{vacancy}/edit', [EmployerVacancyController::class, 'edit'])->middleware('auth')->name('cabinet.vacancies.edit');
Route::put('/cabinet/vacancies/{vacancy}', [EmployerVacancyController::class, 'update'])->middleware('auth')->name('cabinet.vacancies.update');
Route::delete('/cabinet/vacancies/{vacancy}', [EmployerVacancyController::class, 'destroy'])->middleware('auth')->name('cabinet.vacancies.destroy');

Route::get('/cabinet/company', [CompanyController::class, 'edit'])->name('cabinet.company.edit');
Route::post('/cabinet/company', [CompanyController::class, 'update'])->name('cabinet.company.update');

Route::get('/cabinet/favorites',[FavoriteController::class,'index'])->middleware('auth')->name('cabinet.favorites');