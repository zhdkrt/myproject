<?php

use App\Http\Controllers\VacancyController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CabinetController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\EmployerVacancyController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResponseController;

Route::get('/', [VacancyController::class, 'index'])->name('index');
Route::get('/vacancies/{vacancy}', [VacancyController::class, 'show'])->name('show');
Route::get('/companies', [CompanyController::class, 'index'])->name('companiesIndex');
Route::get('/companies/{company}', [CompanyController::class, 'show'])->name('companyShow');
Route::get('/categories', [CategoryController::class, 'index'])->name('categoriesIndex');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categoriesShow');
Route::get('/cabinet', [CabinetController::class, 'index'])->name('cabinet.index');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/cabinet/edit', [CabinetController::class, 'edit'])->name('cabinet.edit');
    Route::put('/cabinet/edit', [CabinetController::class, 'update'])->name('cabinet.update');
});

Route::middleware(['auth', 'seeker'])->group(function () {
    Route::get('/cabinet/resume', [ResumeController::class, 'index'])->name('cabinet.resume');
    Route::get('/cabinet/resume/create', [ResumeController::class, 'create'])->name('cabinet.resume.create');
    Route::post('/cabinet/resume', [ResumeController::class, 'store'])->name('cabinet.resume.store');
    Route::get('/cabinet/resume/{resume}/edit', [ResumeController::class, 'edit'])->name('cabinet.resume.edit');
    Route::put('/cabinet/resume/{resume}', [ResumeController::class, 'update'])->name('cabinet.resume.update');
    Route::delete('/cabinet/resume/{resume}', [ResumeController::class, 'destroy'])->name('cabinet.resume.destroy');
    Route::get('/cabinet/favorites', [FavoriteController::class, 'index'])->name('cabinet.favorites');
    Route::get('/cabinet/responses', [ResponseController::class, 'index'])->name('cabinet.responses');
    Route::post('/vacancies/{vacancy}/respond', [ResponseController::class, 'store'])->name('responses.store');
});

Route::middleware(['auth', 'employer'])->group(function () {
    Route::get('/cabinet/vacancies', [EmployerVacancyController::class, 'index'])->name('cabinet.vacancies');
    Route::get('/cabinet/vacancies/create', [EmployerVacancyController::class, 'create'])->name('cabinet.vacancies.create');
    Route::post('/cabinet/vacancies', [EmployerVacancyController::class, 'store'])->name('cabinet.vacancies.store');
    Route::get('/cabinet/vacancies/{vacancy}/edit', [EmployerVacancyController::class, 'edit'])->name('cabinet.vacancies.edit');
    Route::put('/cabinet/vacancies/{vacancy}', [EmployerVacancyController::class, 'update'])->name('cabinet.vacancies.update');
    Route::delete('/cabinet/vacancies/{vacancy}', [EmployerVacancyController::class, 'destroy'])->name('cabinet.vacancies.destroy');
    Route::get('/cabinet/company', [CompanyController::class, 'edit'])->name('cabinet.company.edit');
    Route::post('/cabinet/company', [CompanyController::class, 'update'])->name('cabinet.company.update');
    Route::get('/cabinet/vacancies/{vacancy}/responses', [ResponseController::class, 'vacancyResponses'])->name('cabinet.vacancies.responses');
    Route::patch('/cabinet/responses/{response}/status', [ResponseController::class, 'updateStatus'])->name('responses.status');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::patch('/users/{user}/role', [AdminController::class, 'updateRole'])->name('users.role');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::get('/vacancies', [AdminController::class, 'vacancies'])->name('vacancies');
    Route::patch('/vacancies/{vacancy}/approve', [AdminController::class, 'approveVacancy'])->name('vacancies.approve');
    Route::patch('/vacancies/{vacancy}/reject', [AdminController::class, 'rejectVacancy'])->name('vacancies.reject');
});