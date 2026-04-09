<?php

namespace App\Http\Controllers;

use App\Models\Response;
use App\Models\Vacancy;

use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function store(Vacancy $vacancy)
    {
        $already = Response::where('user_id', auth()->id())
                           ->where('vacancy_id', $vacancy->id)
                           ->exists();

        if ($already) {
            return back()->with('error', 'Вы уже откликнулись на эту вакансию.');
        }

        Response::create([
            'user_id'    => auth()->id(),
            'vacancy_id' => $vacancy->id,
            'status'     => 'pending',
        ]);

        return back()->with('success', 'Отклик отправлен! Ожидайте ответа.');
    }

    public function index()
    {
        $responses = Response::with(['vacancy.company'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('cabinet.responses.index', ['responses'=>$responses]);
    }

    public function vacancyResponses(Vacancy $vacancy)
    {
        $company = auth()->user()->company;

        if (!$company || $vacancy->company_id !== $company->id) {
            abort(403);
        }

        $responses = Response::with('user')->where('vacancy_id', $vacancy->id)->orderBy('created_at', 'desc')->get();

        return view('cabinet.responses.vacancy', ['vacancy'=>$vacancy, 'responses'=>$responses]);
    }

    public function updateStatus(Request $request, Response $response)
    {
        $request->validate([
            'status' => ['required', 'in:accepted,rejected'],
        ]);

        $company = auth()->user()->company;

        if (!$company || $response->vacancy->company_id !== $company->id) {
            abort(403);
        }

        $response->update(['status' => $request->status]);

        return back()->with('success', 'Статус отклика обновлён.');
    }
}
