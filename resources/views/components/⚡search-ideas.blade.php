<?php

use App\IdeaStatus;
use App\Models\Idea;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public string $search = '';
    public string $status = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedStatus()
    {
        $this->resetPage();
    }

    public function getIdeasProperty()
    {
        return Idea::query()
            ->with('user')

            ->when(
                $this->status,
                fn ($query) => $query->where('status', $this->status)
            )

            ->when(
                $this->search,
                fn ($query) => $query->where(function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                })
            )

            ->latest()
            ->paginate(6);
    }
};
?>

<div class="space-y-6">

    {{-- Filtros por status --}}
    <div class="flex gap-2 flex-wrap">

        <button
            wire:click="$set('status', '')"
            class="btn {{ $status === '' ? '' : 'btn-outlined' }}"
        >
            All
        </button>

        @foreach (IdeaStatus::cases() as $ideaStatus)

            <button
                wire:click="$set('status', '{{ $ideaStatus->value }}')"
                class="btn {{ $status === $ideaStatus->value ? '' : 'btn-outlined' }}"
            >
                {{ $ideaStatus->label() }}
            </button>

        @endforeach

    </div>

    {{-- Busca --}}
    <input
        wire:model.live="search"
        type="text"
        placeholder="{{ __('general.search_ideas') }}"
        class="input w-full"
    >

    {{-- Lista --}}
    <div class="grid md:grid-cols-2 gap-6">

            @forelse ($this->ideas as $idea)

                <x-idea.card :idea="$idea" />

            @empty

            <x-card>
                {{ __('general.notfound') }}
            </x-card>

        @endforelse

    </div>

    {{-- Paginação --}}
    <div class="mt-6">
        {{ $this->ideas->links() }}
    </div>

</div>