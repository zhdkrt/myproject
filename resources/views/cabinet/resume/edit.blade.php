@extends('base')

@section('title', 'Редактировать резюме')

@section('content')
    <h1 class="mb-4">Редактировать резюме</h1>

    <form action="{{ route('cabinet.resume.update', $resume->id) }}" method="POST" class="col-md-6">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Желаемая должность</label>
            <select name="desired_position_id" class="form-select">
                <option value="">-- Выберите должность --</option>
                @foreach($positions as $position)
                    <option value="{{ $position->id }}"
                        {{ $resume->desired_position_id == $position->id ? 'selected' : '' }}>
                        {{ $position->position_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">О себе</label>
            <textarea name="about_me" class="form-control" rows="5">{{ $resume->about_me }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="{{ route('cabinet.resume') }}" class="btn btn-secondary">Отмена</a>
    </form>
@endsection