<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Models\Position;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function index(){
        $resume = Resume::where('user_id', auth()->id())->with('desiredPosition')->first();
        return view('cabinet.resume.index', ['resume' => $resume]);
    }

    public function create(){
        $positions = Position::all();
        return view('cabinet.resume.create', ['positions' => $positions]);
    }

    public function store(Request $request){
        $request->validate([
            'desired_position_id' => 'required|exists:positions,id',
            'about_me' => 'nullable|string|max:1000',
        ]);

        Resume::create([
            'user_id' => auth()->id(),
            'desired_position_id' => $request->desired_position_id,
            'about_me' => $request->about_me,
        ]);

        return redirect()->route('cabinet.resume')->with('success', 'Резюме создано!');
    }

    public function edit(Resume $resume){
        $positions = Position::all();
        return view('cabinet.resume.edit', ['resume' => $resume, 'positions' => $positions]);
    }

    public function update(Request $request, Resume $resume){
        $request->validate([
            'desired_position_id' => 'required|exists:positions,id',
            'about_me' => 'nullable|string|max:1000',
        ]);

        $resume->update([
            'desired_position_id' => $request->desired_position_id,
            'about_me' => $request->about_me,
        ]);

        return redirect()->route('cabinet.resume')->with('success', 'Резюме обновлено!');
    }

    public function destroy(Resume $resume){
        $resume->delete();
        return redirect()->route('cabinet.resume')->with('success', 'Резюме удалено!');
    }
}
