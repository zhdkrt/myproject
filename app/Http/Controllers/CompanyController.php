<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;


class CompanyController extends Controller
{
    public function index(){
        $companies = Company::orderBy('company_name')->get();

        return view('companiesIndex', [
            'companies' => $companies,
        ]);
    }
    
    public function show(Company $company)
    {
        $company->load(['vacancies.position', 'vacancies.category']);

        return view('companiesShow', [
            'company' => $company,
        ]);
    }
}
