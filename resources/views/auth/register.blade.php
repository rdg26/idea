<x-layout>
    <x-form.form 
    :title="__('auth.register_title')" 
    :description="__('auth.start_tracking')">
    <form action="/register" method="POST" class="mt-10 space-y-4">
                @csrf

              
                <x-form.field name="name" :label="__('auth.name')"/>
                <x-form.field name="email" :label="__('auth.email')" type="email" />
                <x-form.field name="password" :label="__('auth.password')" type="password" />
                <button type="submit" class="btn mt-2 h-10 w-full">{{ __('auth.create_account') }}</button>

              
            </form>
    </x-form.form> 
    
</x-layout>