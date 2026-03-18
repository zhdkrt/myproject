<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Vacancy;

class VacancyController extends Controller
{
    public function index(){
        $vacancies = Vacancy::with(['company', 'category', 'position'])->where('status', 'active')->orderBy('id', 'desc')->get();

        return view('index', [
            'vacancies' => $vacancies,
        ]);
    }
    
     public function show(Vacancy $vacancy){
        $vacancy->load(['company', 'category', 'position']);

        return view('show', [
            'vacancy' => $vacancy,
        ]);
    }
}
