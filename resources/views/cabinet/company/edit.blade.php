@extends('base')

@section('title', 'Профиль компании')

@section('content')
    <h1 class="mb-4">Профиль компании</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('cabinet.company.update') }}" method="POST" class="col-md-6">
        @csrf

        <div class="mb-3">
            <label class="form-label">Название компании</label>
            <input
                type="text"
                name="company_name"
                class="form-control"
                value="{{ old('company_name', $company->company_name ?? '') }}"
            >
            @error('company_name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Описание</label>
            <textarea
                name="description"
                class="form-control"
                rows="5"
            >{{ old('description', $company->description ?? '') }}</textarea>
            @error('description')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            Сохранить
        </button>
        <a href="{{ route('cabinet.index') }}" class="btn btn-secondary">
            Назад
        </a>
    </form>
@endsection