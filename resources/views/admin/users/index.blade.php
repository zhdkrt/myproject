@extends('admin.layout')

@section('admin-content')

<h4 class="mb-4 fw-bold">Пользователи</h4>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Роль</th>
                    <th>Дата регистрации</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="text-muted small">{{ $user->id }}</td>
                    <td class="fw-medium">{{ $user->name }}</td>
                    <td class="text-muted">{{ $user->email }}</td>
                    <td>
                        @php
                            $badge = match($user->role) {
                                'admin'               => 'danger',
                                'employer'            => 'primary',
                                'seeker', 'jobseeker' => 'success',
                                default               => 'secondary',
                            };
                        @endphp
                        <span class="badge bg-{{ $badge }}">{{ $user->role }}</span>
                    </td>
                    <td class="text-muted small">{{ $user->created_at->format('d.m.Y') }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">

                            <form method="POST"
                                  action="{{ route('admin.users.role', $user) }}"
                                  class="d-flex align-items-center gap-1">
                                @csrf
                                @method('PATCH')
                                <select name="role" class="form-select form-select-sm" style="width: 130px;">
                                    <option value="seeker"   {{ in_array($user->role, ['seeker','jobseeker']) ? 'selected' : '' }}>
                                        Соискатель
                                    </option>
                                    <option value="employer" {{ $user->role === 'employer' ? 'selected' : '' }}>
                                        Работодатель
                                    </option>
                                    <option value="admin"    {{ $user->role === 'admin'    ? 'selected' : '' }}>
                                        Админ
                                    </option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-dark">
                                    Сохранить
                                </button>
                            </form>

                            @if($user->id !== auth()->id())
                            <form method="POST"
                                  action="{{ route('admin.users.delete', $user) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    Удалить
                                </button>
                            </form>
                            @endif

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $users->links() }}
</div>

@endsection