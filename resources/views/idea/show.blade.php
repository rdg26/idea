<x-layout>
    <div class="py-8 max-w-4xl mx-auto">
        <div class="flex justify-between items-center">
            <a href="{{ route('idea.index') }}" class="flex items-center gap-x-2 text-sm font-medium">
                <x-icons.arrow-back/>
                {{ __('idea.back_to_ideas') }}</a>
        

            <div class="gap-x-3 flex items-center">
                <button 
                x-data
                class="btn btn-outlined"
                data-test="edit-idea-button"
                @click="$dispatch('open-modal', 'edit-idea')"            
                >
                @if ($idea->user->is(auth()->user()))
                <x-icons.external />{{ __('idea.edit') }}</button>
                <form method='POST' action="{{ route('idea.destroy', $idea) }}">
                @endif
                    @csrf
                    @method('DELETE')
                <button
                    class="btn btn-outlined text-red-500"
                    x-data
                    :disabled="!window.appOnline"
                    :class="{
                        'opacity-50 cursor-not-allowed':
                        !window.appOnline
                    }"
                >{{ __('idea.delete') }}</button>
                </form>
            </div>
        </div>
        
        <div class="mt-8 space-y-6">
          {{-- Imagem antiga (legacy) --}}
@if ($idea->image_path)

    <div class="rounded-lg overflow-hidden">
        <x-loading-image
            :src="asset('storage/' . $idea->image_path)"
            :alt="$idea->title"
            class="w-full h-auto object-cover"
        />
    </div>

@endif

{{-- Galeria nova --}}
@if ($idea->images->count())

    <div class="grid md:grid-cols-2 gap-4">

        @foreach ($idea->images as $image)

            <div class="space-y-2">

                <div class="rounded-lg overflow-hidden">
                    <x-loading-image
                        :src="asset('storage/' . $image->path)"
                        :alt="$idea->title"
                        class="w-full h-64 object-cover"
                    />
                </div>

                <a
                    href="{{ route('image.download', $image) }}"
                    class="btn btn-outlined w-full"
                >
                    ⬇ Download
                </a>

            </div>

        @endforeach

    </div>

@endif
            <h1 class="font-bold text-4xl">{{ $idea->title}}</h1>

            <div class="mt-2 flex gap-x-3 items-center">
                <x-idea.status-label :status="$idea->status->value">{{ $idea->status->label() }}</x-idea.status-label>
                <div class="text-muted-foreground text-sm">{{ $idea->created_at->diffForHumans() }}</div>
            </div>

            <div class="mt-2 flex gap-x-3 items-center">

            <x-idea.status-label :status="$idea->status->value">
                {{ $idea->status->label() }}
            </x-idea.status-label>

            <livewire:idea-like :idea="$idea" />

             </div>

            @if ($idea->description)
            <x-card class="mt-6">
                <div class="text-foreground max-w-none cursor-pointer">{{ $idea->description }}</div>
            </x-card>
            @endif

            @if ($idea->steps->count())
            <div>
                <h3 class="font-bold text-xl mt-6">{{ __('idea.actionable_steps') }}</h3>
                
                <div class="mt-3 space-y-2">
                    @foreach ($idea->steps as $step)
                        <x-card class="text-primary font-medium flex gap-x-3 items-center">
                            <form method="POST" action="{{ route('step.update', $step) }}">
                                @csrf
                                @method('PATCH')
                            <div class="flex items-center gap-x-3">
                                <button type="submit" role="checkbox" class="size-5 flex items-center justify-center rounded-lg text-primary-foreground {{ $step->completed ? 'bg-primary' : 'border border-primary' }}">&check;</button>
                                <span class="{{ $step->completed ? 'line-through text-muted-foreground' : '' }}">{{ $step->description }}</span>
                            </div>
                            </form>
                        </x-card>
                        
                    @endforeach
                </div>
            </div>
            @endif

          
        </div>

        <x-idea.modal :idea="$idea" />
    </div>
</x-layout>