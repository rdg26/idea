<x-layout>
 <div>
    <header class="py-8 md:py-12">
        <h1 class="text-3xl font-bold">{{ __('idea.ideas') }}</h1>
        <p class="text-muted-foreground text-sm mt-2">{{ __('idea.ideas_subtitle') }}</p>
    
        <x-card
        x-data
        @click="$dispatch('open-modal', 'create-idea')" 
        is="button" 
        type="button"
        data-test="create-idea-button"
        class="mt-10 cursor-pointer h-32 w-full text-left">
            <p>{{ __('idea.what_is_the_idea') }}</p>
        </x-card>
    
    </header>
    

    <livewire:search-ideas />

        
       
    </div>
    <!--modal -->
   <x-idea.modal />

</div>

</x-layout>