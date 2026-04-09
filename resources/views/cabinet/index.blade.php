@extends('base')

@section('title', 'Личный кабинет')

@section('content')
    @guest
        <div class="text-center mt-5">
            <h2 class="mb-4">Для доступа к кабинету необходимо войти</h2>
            <a href="{{ route('login') }}" class="btn btn-primary me-2">Войти</a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary">Зарегистрироваться</a>
        </div>
    @else
        <h1 class="mb-4">Личный кабинет</h1>

        <div class="card p-4 mb-4">
            <h5>{{ $user->name }}</h5>
            <p class="text-muted">{{ $user->email }}</p>
            <span class="badge bg-secondary">{{ $user->role }}</span>
            <a href="{{ route('cabinet.edit') }}" class="btn btn-outline-secondary mt-2">Редактировать профиль</a>
        </div>

        @if($user->role === 'seeker' || $user->role === 'jobseeker')
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('cabinet.resume') }}" class="btn btn-primary">Моё резюме</a>
                <a href="{{ route('cabinet.favorites') }}" class="btn btn-secondary">Избранное</a>
                <a href="{{ route('cabinet.responses') }}" class="btn btn-outline-primary">Мои отклики</a>
            </div>
        @elseif($user->role === 'employer')
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('cabinet.company.edit') }}" class="btn btn-outline-primary">
                    Профиль компании
                </a>
                <a href="{{ route('cabinet.vacancies') }}" class="btn btn-primary">
                    Мои вакансии
                </a>
            </div>
        @endif
    @endguest
@endsection