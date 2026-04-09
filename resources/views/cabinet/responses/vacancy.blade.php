@extends('base')

@section('title', 'Отклики на вакансию')

@section('content')
<div class="container mt-4">
    <h1 class="mb-1">Отклики на вакансию</h1>
    <p class="text-muted mb-4">{{ $vacancy->title }}</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse($responses as $response)
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="mb-1">{{ $response->user->name }}</h5>
                    <p class="text-muted mb-1">{{ $response->user->email }}</p>
                    <small class="text-muted">
                        Отклик от {{ $response->created_at->format('d.m.Y') }}
                    </small>

                    @php
                        $badge = match($response->status) {
                            'pending'  => ['warning', 'На рассмотрении'],
                            'accepted' => ['success', 'Принят'],
                            'rejected' => ['danger',  'Отклонён'],
                            default    => ['secondary', $response->status],
                        };
                    @endphp
                    <div class="mt-2">
                        <span class="badge bg-{{ $badge[0] }}">{{ $badge[1] }}</span>
                    </div>
                </div>

                @if($response->status === 'pending')
                    <div class="d-flex gap-2">
                        <form method="POST" action="{{ route('responses.status', $response) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="accepted">
                            <button type="submit" class="btn btn-success btn-sm">Принять</button>
                        </form>
                        <form method="POST" action="{{ route('responses.status', $response) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="btn btn-danger btn-sm">Отклонить</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div class="text-center text-muted py-5">
            <p>Откликов на эту вакансию пока нет</p>
        </div>
    @endforelse

    <a href="{{ route('cabinet.vacancies') }}" class="btn btn-secondary mt-3">Назад к вакансиям</a>
</div>
@endsection