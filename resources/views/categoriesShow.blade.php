@extends('base')

@section('title', 'Вакансии категории '.$category->name)

@section('content')
<div class="container mt-4">
    <h1>Категория: {{ $category->name }}</h1>

    <hr>

    @if($category->vacancies->isEmpty())
        <p>В этой категории пока нет вакансий.</p>
    @else
        <div class="row">
            @foreach($category->vacancies as $vacancy)
                <div class="col-md-6 mb-3">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $vacancy->title }}</h5>

                            <p class="card-text text-muted">
                                {{ $vacancy->company->company_name ?? 'Компания не указана' }}
                                @if($vacancy->position)
                                    · {{ $vacancy->position->position_name }}
                                @endif
                            </p>

                            @if($vacancy->salary_min || $vacancy->salary_max)
                                <p class="card-text">
                                    <strong>Зарплата:</strong>
                                    @if($vacancy->salary_min && $vacancy->salary_max)
                                        от {{ $vacancy->salary_min }} до {{ $vacancy->salary_max }}
                                    @elseif($vacancy->salary_min)
                                        от {{ $vacancy->salary_min }}
                                    @else
                                        до {{ $vacancy->salary_max }}
                                    @endif
                                </p>
                            @endif

                            <div class="mt-auto">
                                <a href="{{ route('show', $vacancy->id) }}" class="btn btn-outline-primary">
                                    Открыть вакансию
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <a href="{{ route('categoriesIndex') }}" class="btn btn-secondary mt-3">
        Назад к списку категорий
    </a>
</div>
@endsection
