@props(['idea'])

<div class="relative">

    <x-card href="{{ route('idea.show', $idea) }}">

        <h3 class="text-foreground text-lg">
            {{ $idea->title }}
        </h3>

        <p class="text-sm text-muted-foreground">
            {{ $idea->user->name }}
        </p>

        <div class="mt-3 text-muted-foreground">
            {{ $idea->description }}
        </div>

        <div class="mt-4">
            <span>
                {{ $idea->created_at->diffForHumans() }}
            </span>
        </div>

    </x-card>

    <div class="absolute bottom-4 right-4 z-10">

        <livewire:idea-like
            :idea="$idea"
            :key="'like-'.$idea->id"
        />

    </div>

</div>