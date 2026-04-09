<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use App\Models\Category;
use App\Models\Position;
use Illuminate\Http\Request;

class EmployerVacancyController extends Controller
{
    public function index()
    {
        $company = auth()->user()->company;

        if (!$company) {
            return redirect()->route('cabinet.index')
                ->with('warning', 'Сначала создайте профиль компании');
        }

        $vacancies = Vacancy::where('company_id', $company->id)->with('position', 'category')->get();

        return view('cabinet.vacancies.index', ['vacancies' => $vacancies]);
    }

    public function create()
    {
        $positions  = Position::all();
        $categories = Category::all();
        return view('cabinet.vacancies.create', compact('positions', 'categories'));
    }

    public function store(Request $request)
    {
        $company = auth()->user()->company;

        if (!$company) {
            return redirect()->route('cabinet.index')->with('warning', 'Сначала создайте профиль компании');
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'salary_min'  => 'nullable|integer',
            'salary_max'  => 'nullable|integer',
            'position_id' => 'nullable|exists:positions,id',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Vacancy::create([
            'company_id'  => $company->id,
            'title'       => $request->title,
            'description' => $request->description,
            'salary_min'  => $request->salary_min,
            'salary_max'  => $request->salary_max,
            'position_id' => $request->position_id,
            'category_id' => $request->category_id,
            'status'      => 'pending',
        ]);

        return redirect()->route('cabinet.vacancies')->with('success', 'Вакансия создана');
    }

    public function edit(Vacancy $vacancy)
    {
        $this->authorize('update', $vacancy);

        $positions  = Position::all();
        $categories = Category::all();
        return view('cabinet.vacancies.edit', compact('vacancy', 'positions', 'categories'));
    }

    public function update(Request $request, Vacancy $vacancy)
    {
        $this->authorize('update', $vacancy);

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'salary_min'  => 'nullable|integer',
            'salary_max'  => 'nullable|integer',
            'position_id' => 'nullable|exists:positions,id',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $vacancy->update([
            'title'       => $request->title,
            'description' => $request->description,
            'salary_min'  => $request->salary_min,
            'salary_max'  => $request->salary_max,
            'position_id' => $request->position_id,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('cabinet.vacancies')->with('success', 'Вакансия обновлена');
    }

    public function destroy(Vacancy $vacancy)
    {
        $this->authorize('delete', $vacancy);

        $vacancy->delete();
        return redirect()->route('cabinet.vacancies')->with('success', 'Вакансия удалена');
    }
}