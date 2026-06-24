<x-layout>
    <x-form.form :title="__('profile.edit_account')" :description="__('profile.edit_description')">
    <form action="/profile" method="POST" class="mt-10 space-y-4">
                @csrf
                @method('PATCH')
              
                <x-form.field name="name" :label="__('profile.name')" :value="$user->name"/>
                <x-form.field name="email" :label="__('profile.email')" type="email" :value="$user->email"/>
                <x-form.field name="password" :label="__('profile.new_password')" type="password" />
                <button type="submit" class="btn mt-2 h-10 w-full">{{ __('profile.update_account') }}</button>

              
            </form>
    </x-form.form> 
    
</x-layout>