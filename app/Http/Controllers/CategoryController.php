<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();

        return view('categoriesIndex', [
            'categories' => $categories,
        ]);
    }

    public function show(Category $category)
    {
        $category->load(['vacancies.company', 'vacancies.position']);

        return view('categoriesShow', [
            'category' => $category,
        ]);
    }
}
