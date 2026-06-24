<?php

use App\Models\Idea;
use Livewire\Component;

new class extends Component
{
    public Idea $idea;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function toggleLike()
    {
        $user = auth()->user();

        if (! $user) {
            return;
        }

        $liked = $user
            ->likedIdeas()
            ->where('idea_id', $this->idea->id)
            ->exists();

        if ($liked) {

            $user
                ->likedIdeas()
                ->detach($this->idea->id);

        } else {

            $user
                ->likedIdeas()
                ->attach($this->idea->id);

        }
    }

    public function getLikesCountProperty()
    {
        return $this->idea->likes()->count();
    }

    public function getLikedProperty()
    {
        if (! auth()->check()) {
            return false;
        }

        return auth()
            ->user()
            ->likedIdeas()
            ->where('idea_id', $this->idea->id)
            ->exists();
    }
};

?>
<div
    wire:click.stop
    @click.stop>
<button
    wire:click="toggleLike"
    class="btn btn-outlined"
>
    {{ $this->liked ? '❤️' : '🤍' }}

    {{ $this->likesCount }}
</button>
</div>