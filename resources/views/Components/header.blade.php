<header>
    <div class="header-container container">
        <div class="header__logo">
            <a href="/">
                <img src="/images/header/devcamp-logo.svg" class="header__logo-image" alt="">
            </a>
        </div>
        <div class="header__nav">
            <nav class="header__menu">
                <a href="/" class="menu__item-link">
                    Главная
                </a>
                <a href="{{ route('catalog') }}" class="menu__item-link">
                    Курсы
                </a>
                <a href="{{ route('about') }}" class="menu__item-link">
                    О нас
                </a>
                @if(Auth::check() && Auth::user()->email === config('app.admin'))
                    <a href="{{ route('admin') }}" class="menu__item-link">
                        Админ-панель
                    </a>
                @endif
                @guest
                    <a href="{{ route('login') }}" class="menu__item-btn">
                        Войти
                    </a>
                @endguest
                @auth
                    <a href="{{ route('profile') }}" class="menu__item-btn">
                        Профиль
                    </a>
                @endauth
            </nav>
        </div>
    </div>
</header>
