<x-layout>
    <x-form.form :title="__('auth.login_title')" :description="__('auth.welcome_back')">
    <form action="/login" method="POST" class="mt-10 space-y-4">
                @csrf
                <x-form.field name="email" :label="__('auth.email')" type="email" />
                <x-form.field name="password" :label="__('auth.password')" type="password" />
                <button type="submit" class="btn mt-2 h-10 w-full">{{ __('auth.login_title') }}</button>

                           
            </form>
    </x-form.form>  
</x-layout>