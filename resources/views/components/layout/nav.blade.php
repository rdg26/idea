<nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm py-2">
    <div class="container">

        <a href="/" class="navbar-brand fw-bold fs-3">
            Idea
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMain"
            aria-controls="navbarMain"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">

            <div class="navbar-nav mx-lg-auto gap-lg-2">

                <a
                    class="nav-link"
                    href="{{ route('language.switch', 'en') }}"
                >
                    EN
                </a>

                <a
                    class="nav-link"
                    href="{{ route('language.switch', 'pt_BR') }}"
                >
                    PT
                </a>

                <a
                    class="nav-link"
                    href="{{ route('language.switch', 'es') }}"
                >
                    ES
                </a>

            </div>

            <div class="navbar-nav ms-lg-auto align-items-lg-center gap-2">

                @auth

                    <a
                        class="nav-link"
                        href="{{ route('profile.edit') }}"
                    >
                        {{ __('navigation.edit_profile') }}
                    </a>

                    <form method="POST" action="/logout">
                        @csrf

                        <button
                            type="submit"
                            class="btn btn-outline-secondary btn-sm"
                        >
                            {{ __('navigation.logout') }}
                        </button>
                    </form>

                @endauth

                @guest

                    <a
                        class="nav-link"
                        href="/login"
                    >
                        {{ __('navigation.login') }}
                    </a>

                    <a
                        href="/register"
                        class="btn btn-primary btn-sm"
                    >
                        {{ __('navigation.register') }}
                    </a>

                @endguest

            </div>

        </div>

    </div>
</nav>