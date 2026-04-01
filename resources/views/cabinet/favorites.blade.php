@extends('base')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Избранные вакансии</h1>

    @if($favorites->isEmpty())
        <p class="text-muted">Вы ещё не добавили вакансии в избранное.</p>
    @else
        @foreach($favorites as $fav)
            <div class="card mb-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-1">
                            <a href="{{ route('show', $fav->vacancy) }}">
                                {{ $fav->vacancy->title }}
                            </a>
                        </h5>
                        <p class="text-muted mb-0">{{ $fav->vacancy->company->name }}</p>
                    </div>
                    <livewire:favorite-button 
                        :vacancyId="$fav->vacancy_id" 
                        :key="$fav->vacancy_id" 
                    />
                </div>
            </div>
        @endforeach

        {{ $favorites->links() }}
    @endif
</div>
@endsection