@extends('admin.layout')

@section('admin-content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <h4 class="fw-bold mb-0">Вакансии</h4>

    <div class="btn-group">
        @foreach(['pending' => 'На модерации', 'active' => 'Активные', 'rejected' => 'Отклонённые', 'all' => 'Все'] as $val => $label)
            <a href="{{ route('admin.vacancies', ['status' => $val]) }}"
               class="btn btn-sm {{ $status === $val ? 'btn-dark' : 'btn-outline-dark' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>
</div>

<div class="card border-0 shadow-sm">
    @forelse($vacancies as $vacancy)
        <div class="d-flex align-items-start justify-content-between p-3 border-bottom">

            <div class="flex-grow-1">
                <div class="d-flex align-items-center gap-2 mb-1">
                    <span class="fw-semibold">{{ $vacancy->title }}</span>
                    @php
                        $badge = match($vacancy->status) {
                            'pending'  => 'warning',
                            'active'   => 'success',
                            'rejected' => 'danger',
                            default    => 'secondary',
                        };
                    @endphp
                    <span class="badge bg-{{ $badge }}">{{ $vacancy->status }}</span>
                </div>
                <div class="text-muted small">
                    {{ $vacancy->company->company_name ?? '—' }}
                    @if($vacancy->salary_min || $vacancy->salary_max)
                        · {{ $vacancy->salary_min }}–{{ $vacancy->salary_max }} $
                    @else
                        · Зарплата не указана
                    @endif
                    · {{ $vacancy->created_at->format('d.m.Y') }}
                </div>
                @if($vacancy->description)
                    <p class="text-muted small mt-1 mb-0" style="max-width: 600px;">
                        {{ Str::limit($vacancy->description, 120) }}
                    </p>
                @endif
            </div>

            @if($vacancy->status === 'pending')
            <div class="d-flex gap-2 ms-3 flex-shrink-0">
                <form method="POST" action="{{ route('admin.vacancies.approve', $vacancy) }}">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn btn-sm btn-success">Одобрить</button>
                </form>
                <form method="POST" action="{{ route('admin.vacancies.reject', $vacancy) }}">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn btn-sm btn-danger">Отклонить</button>
                </form>
            </div>
            @endif

        </div>
    @empty
        <div class="p-5 text-center text-muted">
            Вакансий с этим статусом нет
        </div>
    @endforelse
</div>

<div class="mt-3">
    {{ $vacancies->links() }}
</div>

@endsection