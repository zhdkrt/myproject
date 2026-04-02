@extends('base')

@section('title', 'Вакансии')

@section('content')
    <h1 class="mb-4">Актуальные вакансии</h1>
        <div class="row g-3">
            @livewire('vacancy-search')
        </div>
@endsection
