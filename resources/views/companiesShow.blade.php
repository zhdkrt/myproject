@extends('base')

@section('title', 'Вакансии компании '.$company->company_name)

@section('content')
<div class="container mt-4">
    <h1>{{ $company->company_name }}</h1>

    @if($company->description)
        <p class="mt-3">{{ $company->description }}</p>
    @endif

    <hr>

    <h4>Вакансии компании</h4>

    @if($company->vacancies->isEmpty())
        <p class="mt-2">У этой компании пока нет опубликованных вакансий.</p>
    @else
        <div class="row mt-3">
            @foreach($company->vacancies as $vacancy)
                <div class="col-md-6 mb-3">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $vacancy->title }}</h5>

                            <p class="card-text text-muted">
                                {{ $vacancy->position->position_name ?? '' }}
                                @if(!empty($vacancy->category))
                                    · {{ $vacancy->category->name }}
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

    <a href="{{ route('companiesIndex') }}" class="btn btn-secondary mt-3">
        Назад к списку компаний
    </a>
</div>
@endsection
