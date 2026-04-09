@extends('base')

@section('title', 'Мои отклики')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Мои отклики</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @forelse($responses as $response)
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">
                        <a href="{{ route('show', $response->vacancy) }}">
                            {{ $response->vacancy->title }}
                        </a>
                    </h5>
                    <p class="text-muted mb-1">
                        {{ $response->vacancy->company->company_name ?? '—' }}
                    </p>
                    <small class="text-muted">
                        Отклик отправлен: {{ $response->created_at->format('d.m.Y') }}
                    </small>
                </div>

                @php
                    $badge = match($response->status) {
                        'pending'  => ['warning', 'На рассмотрении'],
                        'accepted' => ['success', 'Принят'],
                        'rejected' => ['danger',  'Отклонён'],
                        default    => ['secondary', $response->status],
                    };
                @endphp
                <span class="badge bg-{{ $badge[0] }} fs-6">{{ $badge[1] }}</span>
            </div>
        </div>
    @empty
        <div class="text-center text-muted py-5">
            <p>Вы ещё не откликались на вакансии</p>
            <a href="{{ route('index') }}" class="btn btn-primary">Смотреть вакансии</a>
        </div>
    @endforelse

    <a href="{{ route('cabinet.index') }}" class="btn btn-secondary mt-3">Назад в кабинет</a>
</div>
@endsection