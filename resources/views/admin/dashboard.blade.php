@extends('admin.layout')

@section('admin-content')

<h4 class="mb-4 fw-bold">Дашборд</h4>

<div class="row g-3 mb-4">
    <div class="col-6 col-md-4 col-lg-2">
        <div class="card text-center border-0 shadow-sm">
            <div class="card-body">
                <div class="fs-2 fw-bold text-primary">{{ $stats['users'] }}</div>
                <div class="text-muted small">Всего пользователей</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
        <div class="card text-center border-0 shadow-sm">
            <div class="card-body">
                <div class="fs-2 fw-bold text-purple" style="color: #6f42c1;">{{ $stats['employers'] }}</div>
                <div class="text-muted small">Работодателей</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
        <div class="card text-center border-0 shadow-sm">
            <div class="card-body">
                <div class="fs-2 fw-bold text-info">{{ $stats['seekers'] }}</div>
                <div class="text-muted small">Соискателей</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
        <div class="card text-center border-0 shadow-sm">
            <div class="card-body">
                <div class="fs-2 fw-bold text-warning">{{ $stats['pending_vacancies'] }}</div>
                <div class="text-muted small">На модерации</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
        <div class="card text-center border-0 shadow-sm">
            <div class="card-body">
                <div class="fs-2 fw-bold text-success">{{ $stats['active_vacancies'] }}</div>
                <div class="text-muted small">Активных вакансий</div>
            </div>
        </div>
    </div>
</div>

@if($stats['pending_vacancies'] > 0)
    <div class="alert alert-warning d-flex align-items-center justify-content-between">
        <span>
            <strong>{{ $stats['pending_vacancies'] }}</strong> вакансий ожидают модерации
        </span>
        <a href="{{ route('admin.vacancies') }}" class="btn btn-warning btn-sm">
            Перейти к модерации
        </a>
    </div>
@endif

@endsection