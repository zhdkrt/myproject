@extends('base')

@section('title', 'Редактировать профиль')

@section('content')
    <h1 class="mb-4">Редактировать профиль</h1>

    <form action="{{ route('cabinet.update') }}" method="POST" class="col-md-6">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Имя</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Новый пароль (если хотите изменить)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Подтверждение пароля</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="{{ route('cabinet.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
@endsection