<?php

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use App\Models\Vacancy;
use App\Models\Category;
use App\Models\Position;


new class extends Component
{
    use WithPagination;

    public string $search = '';
    public string $categoryId = '';
    public string $positionId = '';
    public string $salaryFrom = '';
    public string $salaryTo = '';

    public function updatedSearch()     { $this->resetPage(); }
    public function updatedCategoryId() { $this->resetPage(); }
    public function updatedPositionId() { $this->resetPage(); }
    public function updatedSalaryFrom() { $this->resetPage(); }
    public function updatedSalaryTo()   { $this->resetPage(); }

    public function resetFilters() {
        $this->search = '';
        $this->categoryId = '';
        $this->positionId = '';
        $this->salaryFrom = '';
        $this->salaryTo = '';
        $this->resetPage();
    }

    #[Computed]
    public function vacancies() {
        return Vacancy::query()
            ->with('company', 'category', 'position')
            ->where('status', 'active')
            ->when($this->search, fn($q) =>
                $q->where('title', 'like', '%' . $this->search . '%')
            )
            ->when($this->categoryId, fn($q) =>
                $q->where('category_id', $this->categoryId)
            )
            ->when($this->positionId, fn($q) =>
                $q->where('position_id', $this->positionId)
            )
            ->when($this->salaryFrom, fn($q) =>
                $q->where('salary_min', '>=', $this->salaryFrom)
            )
            ->when($this->salaryTo, fn($q) =>
                $q->where('salary_max', '<=', $this->salaryTo)
            )->latest()->paginate(10);
    }

    #[Computed]
    public function categories() {
        return Category::all();
    }
    #[Computed]
    public function positions() {
        return Position::all();
    }
};
?>

<div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <input wire:model.live.debounce.400ms="search"
                           type="text" class="form-control"
                           placeholder="Поиск по названию...">
                </div>
                <div class="col-md-2">
                    <select wire:model.live="categoryId" class="form-select">
                        <option value="">Все категории</option>
                        @foreach($this->categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select wire:model.live="positionId" class="form-select">
                        <option value="">Все должности</option>
                        @foreach($this->positions as $pos)
                            <option value="{{ $pos->id }}">{{ $pos->position_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input wire:model.live.debounce.400ms="salaryFrom"
                           type="number" class="form-control"
                           placeholder="Зарплата от">
                </div>
                <div class="col-md-2">
                    <input wire:model.live.debounce.400ms="salaryTo"
                           type="number" class="form-control"
                           placeholder="Зарплата до">
                </div>
            </div>
            <button wire:click="resetFilters" class="btn btn-outline-secondary mt-3">
                Сбросить фильтры
            </button>
        </div>
    </div>

    @forelse($this->vacancies as $vacancy)
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">
                        <a href="{{ route('show', $vacancy) }}">
                            {{ $vacancy->title }}
                        </a>
                    </h5>
                    <p class="text-muted mb-1">{{ $vacancy->company->company_name }}</p>
                    <small class="text-muted">
                        {{ $vacancy->category?->name }}
                        @if($vacancy->salary_min || $vacancy->salary_max)
                            · {{ $vacancy->salary_min }}–{{ $vacancy->salary_max }} руб.
                        @endif
                    </small>
                </div>
                <livewire:favorite-button :vacancyId="$vacancy->id" :key="$vacancy->id" />
            </div>
        </div>
    @empty
        <p class="text-muted">Вакансии не найдены.</p>
    @endforelse

    {{ $this->vacancies->links() }}
</div>