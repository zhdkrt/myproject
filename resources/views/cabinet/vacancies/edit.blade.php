@extends('base')

@section('title', 'Редактировать вакансию')

@section('content')
    <h1 class="mb-4">Редактировать вакансию</h1>

    <form action="{{ route('cabinet.vacancies.update', $vacancy->id) }}" method="POST" class="col-md-6">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Название</label>
            <input type="text" name="title" class="form-control" value="{{ $vacancy->title }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Описание</label>
            <textarea name="description" class="form-control" rows="5">{{ $vacancy->description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Зарплата от (руб.)</label>
            <input type="number" name="salary_min" class="form-control" value="{{ $vacancy->salary_min }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Зарплата до (руб.)</label>
            <input type="number" name="salary_max" class="form-control" value="{{ $vacancy->salary_max }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Должность</label>
            <select name="position_id" class="form-select">
                <option value="">-- Выберите должность --</option>
                @foreach($positions as $position)
                    <option value="{{ $position->id }}"
                        {{ $vacancy->position_id == $position->id ? 'selected' : '' }}>
                        {{ $position->position_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Категория</label>
            <select name="category_id" class="form-select">
                <option value="">-- Выберите категорию --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $vacancy->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="{{ route('cabinet.vacancies') }}" class="btn btn-secondary">Отмена</a>
    </form>
@endsection