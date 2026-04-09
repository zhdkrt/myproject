@extends('base')

@section('title', 'Админ панель')

@section('content')
<div class="row g-0" style="min-height: 80vh;">

    <div class="col-auto bg-dark text-white" style="width: 220px;">
        <div class="p-3 border-bottom border-secondary">
            <div class="fw-bold fs-6">Админ панель</div>
            <small class="text-secondary">{{ auth()->user()->name }}</small>
        </div>
        <nav class="p-2 d-flex flex-column gap-1">
            <a href="{{ route('admin.dashboard') }}"
               class="btn btn-sm text-start {{ request()->routeIs('admin.dashboard') ? 'btn-secondary' : 'btn-dark' }}">
                Дашборд
            </a>
            <a href="{{ route('admin.users') }}"
               class="btn btn-sm text-start {{ request()->routeIs('admin.users*') ? 'btn-secondary' : 'btn-dark' }}">
                Пользователи
            </a>
            <a href="{{ route('admin.vacancies') }}"
               class="btn btn-sm text-start {{ request()->routeIs('admin.vacancies*') ? 'btn-secondary' : 'btn-dark' }}">
                Вакансии
            </a>
        </nav>
    </div>

    <div class="col p-4">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('admin-content')
    </div>

</div>
@endsection