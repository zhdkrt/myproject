@extends('base')

@section('title', 'Категории')

@section('content')
<div class="container mt-4">
    <h1>Категории вакансий</h1>

    @if($categories->isEmpty())
        <p class="mt-3">Пока нет ни одной категории.</p>
    @else
        <ul class="list-group mt-3">
            @foreach($categories as $category)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $category->name }}</span>
                    <a href="{{ route('categoriesShow', $category) }}" class="btn btn-sm btn-primary">
                        Смотреть вакансии
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
