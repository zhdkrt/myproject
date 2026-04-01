<?php

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

new class extends Component
{
    public int $vacancyId;
    public bool $isFavorited = false;

    public function mount($vacancyId){
        $this->vacancyId = $vacancyId;

        if(Auth::check()){
            $this->isFavorited = Favorite::where('user_id',Auth::id())->where('vacancy_id',$this->vacancyId)->exists();
        }
    }

    public function toggle(){
        if(!Auth::check()){
            $this->redirect(route('login'));
            return;
        }

        $existing = Favorite::where('user_id', Auth::id())->where('vacancy_id', $this->vacancyId)->first();

        if($existing){
            $existing->delete();
            $this->isFavorited = false;
        }
        else{
            Favorite::create([
                'user_id'=>Auth::id(),
                'vacancy_id' => $this->vacancyId,
            ]);
            $this->isFavorited = true;
        }
    }
};
?>

<div>
    {{-- Be present above all else. - Naval Ravikant --}}
    <button wire:click="toggle" class="btn {{ $isFavorited ? 'btn-warning' : 'btn-outline-warning' }}">
        {{ $isFavorited ? 'В избранном' : 'В избранное' }}
    </button>
</div>