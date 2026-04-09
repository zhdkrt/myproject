@extends('base')

@section('title', $vacancy->title)

@section('content')
<div class="container mt-4">
    <h1>{{ $vacancy->title }}</h1>

    <p class="text-muted mb-1">
        {{ $vacancy->company->company_name ?? 'Компания не указана' }}
        @if(!empty($vacancy->position))
            · {{ $vacancy->position->position_name }}
            @if(!empty($vacancy->position->seniority))
                ({{ $vacancy->position->seniority }})
            @endif
        @endif
        @if(!empty($vacancy->category))
            · {{ $vacancy->category->name }}
        @endif
    </p>

    <p class="text-muted">
        <strong>Статус:</strong> {{ $vacancy->status }}
    </p>

    @if($vacancy->salary_min || $vacancy->salary_max)
        <p>
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
    <div class="d-flex">
        @auth
            
            @livewire('favorite-button', ['vacancyId' => $vacancy->id])

            @if(in_array(auth()->user()->role, ['seeker', 'jobseeker']))
                @php
                    $alreadyApplied = \App\Models\Response::where('user_id', auth()->id())
                        ->where('vacancy_id', $vacancy->id)
                        ->exists();
                @endphp

                @if($alreadyApplied)
                    <button class="btn btn-secondary ms-2" disabled>Вы уже откликнулись</button>
                @else
                    <form method="POST" action="{{ route('responses.store', $vacancy) }}" class="d-inline ms-2">
                        @csrf
                        <button type="submit" class="btn btn-primary">Откликнуться</button>
                    </form>
                @endif
            @endif
            
        @endauth
    </div>
    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
    @endif

    @if(!empty($vacancy->company) && !empty($vacancy->company->description))
        <hr>
        <h5>О компании</h5>
        <p>{{ $vacancy->company->description }}</p>
    @endif

    <hr>
    <h5>Описание вакансии</h5>
    <p>{{ $vacancy->description }}</p>

    <hr>
    <p class="text-muted">
        <small>
            Создана: {{ $vacancy->created_at?->format('d.m.Y H:i') }}<br>
            Обновлена: {{ $vacancy->updated_at?->format('d.m.Y H:i') }}
        </small>
    </p>

    <a href="{{ route('index') }}" class="btn btn-secondary mt-3">Назад к списку</a>
</div>
@endsection