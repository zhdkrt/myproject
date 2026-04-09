<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vacancy;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $stats = [
            'users'=>User::count(),
            'employers'=>User::where('role','employer')->count(),
            'seekers'=>User::whereIn('role', ['seeker', 'jobseeker'])->count(),
            'pending_vacancies'=>Vacancy::where('status', 'pending')->count(),
            'active_vacancies'=>Vacancy::where('status', 'active')->count(),
        ];

        return view('admin.dashboard', ['stats' => $stats]);
    }

    public function users(){
        $users = User::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.users.index', ['users'=>$users]);
    }

    public function updateRole(Request $request, User $user){
        $request->validate([
            'role'=>['required', 'in:seeker,employer,admin'],
        ]);

        if($user->role === 'admin' && $request->role !== 'admin'){
            $adminCount = User::where('role', 'admin')->count();
            if ($adminCount <= 1){
                return back()->with('error', 'нельзя снять роль с последнего админа');
            }
        }

        $user->update(['role'=>$request->role]);
        
        return back()->with('success', "роль пользователя {$user->name} обновлена");
    }

    public function deleteUser(User $user){
        if($user->id === auth()->id()){
            return back()->with('error', 'нельзя удалить свой аккаунт');
        }

        $user->delete();
        return back()->with('success', "пользователь {$user->name} удален");
    }

    public function vacancies(Request $request){
        $status = $request->get('status','pending');

        $vacancies = Vacancy::with(['company'])->when($status !== 'all', fn($q) => $q->where('status', $status))->orderBy('created_at', 'desc')->paginate(20)->withQueryString();
        
        return view('admin.vacancies.index', ['vacancies'=>$vacancies,'status'=>$status]);
    }

    public function approveVacancy(Vacancy $vacancy){
        $vacancy->update(['status'=>'active']);
        return back()->with('success', "вакансия {$vacancy->title} одобрена");
    }

    public function rejectVacancy(Vacancy $vacancy){
        $vacancy->update(['status'=>'rejected']);
        return back()->with('success', "вакансия {$vacancy->title} отклонена");
    }
}