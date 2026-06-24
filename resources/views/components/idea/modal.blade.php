@props(['idea' => new App\Models\Idea()])

<x-modal name="{{ $idea->exists ? 'edit-idea' : 'create-idea' }}" :title="$idea->exists ? __('idea.edit_idea') : __('idea.new_idea')">
        <form 
            x-data="{
                dirty: false,

                status: @js(old('status', $idea->status->value)),
                newLink: '',
                links: @js(old('links', $idea->links ?? [])),
                newStep: '',
                steps: @js(old('steps', $idea->steps->map->only(['id','description','completed'])))
            }" 
            method="POST" 
            action="{{ $idea->exists ? route('idea.update', $idea) : route('idea.store') }}"
            enctype="multipart/form-data"
            >
            
            @csrf

            @if ($idea->exists)
                @method('PATCH')                
            @endif

            <div class="space-y-6">
                <x-form.field
                    :label="__('idea.title')"
                    name="title"
                    :placeholder="__('idea.title_placeholder')"
                    autofocus
                    required
                    :value="$idea->title"
                    @input="dirty = true"
            />

                <div class="space-y-2">
                    <label for="status" class="label">{{ __('idea.status') }}</label>
                    
                    <div class="flex gap-x-3">
                        @foreach (App\IdeaStatus::cases() as $status)
                            <button 
                                type="button"
                                @click="status = @js($status->value), dirty = true;"
                                data-test="button-status-{{ $status->value }}"
                                class="btn flex-' h-10" 
                                :class="status === @js($status->value)? '' : 'btn-outlined'"
                                >
                                {{ $status->label() }}
                            </button>
                        @endforeach

                        <input type="hidden" name="status" :value="status" class="input">
                    </div>
                    
                    <x-form.error name="status" />
                </div>

                    <div class="space-y-2">
                        <label for="description" class="label">
                            {{ __('idea.description') }}
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            class="textarea"
                            placeholder="{{ __('idea.description_placeholder') }}"
                            @input="dirty = true"
                        >{{ old('description', $idea->description) }}</textarea>

                        <x-form.error name="description" />
                    </div>

                    <div class="space-y-2">
                        <label for="images" :class="{
                              //  'opacity-50 cursor-not-allowed':
                               // !window.appOnline
                            }">
                            {{ __('idea.select_image') }}
                        </label>

                        <input
                            type="file"
                            id="images"
                            name="images[]"
                            multiple
                            class="hidden"
                            
                        >
                        <x-form.error name="image" />
                    </div>

                    <div>
                        <fieldset class="space-y-2">
                            <legend class="label"> {{ __('idea.actionable_steps') }}</legend>
                            
                            <template x-for="(step, index) in steps" :key="step.id || index">
                                <div class="flex gap-x-2 items-center">
                                <input :name="`steps[${index}][description]`" x-model="step.description" @input="dirty = true" class="input"> 
                                <input type="hidden" :name="`steps[${index}][completed]`" :value="step.completed ? '1' : '0'"> 


                                <button
                                    type="button"
                                    aria-label="{{ __('idea.remove_step') }}"
                                    @click="
                                        steps.splice(index, 1);
                                        dirty = true;
                                    "
                                    class="form-muted-icon"
                                >
                                    <x-icons.close />
                                </button>

                            </template>

                            <div class="flex gap-x-2 items-center">
                                <input 
                                x-model="newStep"
                                id="new-step"
                                data-test="new-step"
                                placeholder="{{ __('idea.new_step_placeholder') }}"
                                class="input flex-1"
                                spellcheck="false"
                                >
                                <button type="button" 
                                @click="
                                    steps.push({ id: Date.now(), description: newStep.trim(), completed: false }); 
                                    newStep = '';
                                    dirty = true;
                                    "
                                data-test="submit-new-step-button"
                                :disabled="newStep.trim().length === 0"
                                aria-label="{{ __('idea.add_step') }}"
                                class="form-muted-icon"
                                >
                                    <x-icons.close class="rotate-45" />
                                </button>
                            </div>

                           
                        </fieldset>
                    </div>


                    <div>
                       
                    </div>
                    <div
                        x-show="dirty"
                        x-transition
                        class="text-sm text-yellow-500"
                    >
                        {{ __('idea.unsaved_changes') }}
                    </div>
                    <!--<div
                        x-show="!window.appOnline"
                        class="text-sm text-red-500"
                    >
                        {{ __('idea.offline') }}
                    </div> -->
                    <div class="flex justify-end gap-x-5">
                        <button type="button" @click="$dispatch('close-modal')">{{ __('idea.cancel') }}</button>
                        <button
                            type="submit"
                            class="btn"
                            :disabled="!dirty"
                            :class="{
                                'opacity-50 cursor-not-allowed':
                                !dirty
                            }"
                        >{{ $idea->exists ? __('idea.update') : __('idea.create') }}
                        </button>

                    </div>
            </div>
        </form>  
        @if ($idea->image_path)
        <form method="POST" action="{{ route ('idea.image.destroy', $idea) }}" id="delete-image-form">
            @csrf
            @method('DELETE')
        </form>
        @endif
   </x-modal>