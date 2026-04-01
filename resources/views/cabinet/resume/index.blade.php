@extends('base')

@section('title', 'Моё резюме')

@section('content')
    <h1 class="mb-4">Моё резюме</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($resume)
        <div class="card p-4 mb-4">
            <h5>Желаемая должность: {{ $resume->desiredPosition->position_name ?? 'не указана' }}</h5>
            <p>{{ $resume->about_me ?? 'О себе не указано' }}</p>
            <div class="d-flex gap-2">
                <a href="{{ route('cabinet.resume.edit', $resume->id) }}" class="btn btn-outline-primary">Редактировать</a>
                <form action="{{ route('cabinet.resume.destroy', $resume->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">Удалить</button>
                </form>
            </div>
        </div>
    @else
        <p>У вас ещё нет резюме.</p>
        <a href="{{ route('cabinet.resume.create') }}" class="btn btn-primary">Создать резюме</a>
    @endif

    <a href="{{ route('cabinet.index') }}" class="btn btn-secondary mt-3">Назад</a>
@endsection