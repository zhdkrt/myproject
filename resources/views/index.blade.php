@extends('base')

@section('title', 'Вакансии')

@section('content')
    <h1 class="mb-4">Актуальные вакансии</h1>

    @if ($vacancies->isEmpty())
        <p class="text-muted">Пока нет ни одной опубликованной вакансии.</p>
    @else
        <div class="row g-3">
            @foreach ($vacancies as $vacancy)
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-1">
                                {{ $vacancy->title }}
                            </h5>

                            <p class="mb-1 text-muted">
                                Компания:
                                {{ optional($vacancy->company)->company_name ?? 'Без компании' }}
                            </p>

                            <p class="mb-1 text-muted small">
                                Категория:
                                {{ optional($vacancy->category)->name ?? 'Не указана' }}
                                @if ($vacancy->position)
                                    · Должность: {{ $vacancy->position->position_name }}
                                @endif
                            </p>

                            @if ($vacancy->salary_min || $vacancy->salary_max)
                                <p class="mb-1">
                                    <strong>Зарплата:</strong>
                                    @if ($vacancy->salary_min && $vacancy->salary_max)
                                        {{ $vacancy->salary_min }} – {{ $vacancy->salary_max }} BYN
                                    @elseif ($vacancy->salary_min)
                                        от {{ $vacancy->salary_min }} BYN
                                    @else
                                        до {{ $vacancy->salary_max }} BYN
                                    @endif
                                </p>
                            @endif

                            @if ($vacancy->description)
                                <p class="card-text small text-muted">
                                    {{ $vacancy->description }}
                                </p>
                            @endif
                            <a href="{{ route('show', $vacancy) }}" class="btn btn-primary">
                                Подробнее
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
