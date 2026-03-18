@extends('base')

@section('title', 'Компании')

@section('content')
<div class="container mt-4">
    <h1>Компании</h1>

    @if($companies->isEmpty())
        <p class="mt-3">Пока нет ни одной компании.</p>
    @else
        <div class="row mt-3">
            @foreach($companies as $company)
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $company->company_name }}</h5>

                            @if($company->description)
                                <p class="card-text text-muted">
                                    {{ $company->description }}
                                </p>
                            @endif

                            <div class="mt-auto">
                                <a href="{{ route('companyShow', $company->id) }}" class="btn btn-primary">
                                    Смотреть вакансии
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
