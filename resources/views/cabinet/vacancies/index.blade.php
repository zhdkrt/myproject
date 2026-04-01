@extends('base')

@section('title', 'Мои вакансии')

@section('content')
    <h1 class="mb-4">Мои вакансии</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('cabinet.vacancies.create') }}" class="btn btn-primary mb-3">Добавить вакансию</a>

    @if($vacancies->count() > 0)
        <div class="row">
            @foreach($vacancies as $vacancy)
                <div class="col-md-6 mb-3">
                    <div class="card p-3">
                        <h5>{{ $vacancy->title }}</h5>
                        <p class="text-muted">
                            {{ $vacancy->position->position_name ?? '—' }} · {{ $vacancy->category->name ?? '—' }}
                        </p>
                        <p>
                            @if($vacancy->salary_min || $vacancy->salary_max)
                                @if($vacancy->salary_min) от {{ number_format($vacancy->salary_min, 0, '.', ' ') }} руб. @endif
                                @if($vacancy->salary_max) до {{ number_format($vacancy->salary_max, 0, '.', ' ') }} руб. @endif
                            @else
                                Зарплата не указана
                            @endif
                        </p>
                        <span class="badge bg-{{ $vacancy->status === 'active' ? 'success' : 'secondary' }} mb-2">
                            {{ $vacancy->status }}
                        </span>
                        <div class="d-flex gap-2">
                            <a href="{{ route('cabinet.vacancies.edit', $vacancy->id) }}" class="btn btn-outline-primary btn-sm">Редактировать</a>
                            <form action="{{ route('cabinet.vacancies.destroy', $vacancy->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">Удалить</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>У вас ещё нет вакансий.</p>
    @endif

    <a href="{{ route('cabinet.index') }}" class="btn btn-secondary mt-3">Назад</a>
@endsection