<nav class="border-b border-border px-6">
    <div class="max-w-7xl mx-auto h-16 flex items-center justify-between">
        <div>
            <a href="/">
                <img src="/images/logo.png" width="100" alt="Idea logo">
            </a>
        </div>

        <div class="flex gap-x-3 items-center">
    <a href="{{ route('language.switch', 'en') }}">EN</a>
    <a href="{{ route('language.switch', 'pt_BR') }}">PT</a>
    <a href="{{ route('language.switch', 'es') }}">ES</a>

   
</div>
        

        <div class="flex gap-x-5 items-center">  
           @auth
            <a href="{{ route('profile.edit') }}">{{ __('navigation.edit_profile') }}</a>
               <form method="POST" action="/logout">
                    @csrf
                    <button>{{ __('navigation.logout') }}</button>
               </form>
           @endauth 
           
           @guest               
            <a href="/login">{{ __('navigation.login') }}</a>
            <a href="/register" class="btn">{{ __('navigation.register') }}</a>
            @endguest

        </div>
        
    </div>
</nav>