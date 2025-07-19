<header>
    <div class="header-container container">
        <div class="header__logo">
            <a href="/">
                <img src="/images/header/devcamp-logo.svg" class="header__logo-image" alt="">
            </a>
        </div>
        <div class="header__nav">
            <nav class="header__menu">
                <a href="{{ route('admin') }}" class="menu__item-link">
                    Главная
                </a>
                <a href="{{ route('users.index') }}" class="menu__item-link">
                    Все пользователи
                </a>
                <a href="{{ route('courses.index') }}" class="menu__item-link">
                    Курсы
                </a>
            </nav>
        </div>
    </div>
</header>
