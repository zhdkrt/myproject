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
        // $company->load(['vacancies.position', 'vacancies.category']);
        $vacancies = $company->vacancies()->where('status','active')->with('position','category')->get();
        return view('companiesShow', [
            'company' => $company,
            'vacancies' => $vacancies,
        ]);
    }

    public function edit()
    {
        $company = auth()->user()->company;

        return view('cabinet.company.edit', compact('company'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'description'  => 'required|string',
        ]);

        $user = auth()->user();

        if ($user->company) {
            $user->company->update([
                'company_name' => $request->company_name,
                'description'  => $request->description,
            ]);
        } else {
            Company::create([
                'user_id'      => $user->id,
                'company_name' => $request->company_name,
                'description'  => $request->description,
            ]);
        }

        return redirect()->route('cabinet.company.edit')->with('success', 'Профиль компании сохранён');
    }
}
