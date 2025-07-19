@extends('../Components/layout')

@section('header')
    @include('../Components/header')
@endsection

@section('content')
    <main class="auth__page">
        <section class="auth__section ">
            <div class="auth__container container">
                <div class="auth__info">
                    <div class="auth__logo">
                        <img src="/images/header/devcamp-logo.svg" class="header__logo-image" alt="">
                    </div>
                    <div class="auth__description">
                        <p>Не останавливайся на достигнутом!</p>
                    </div>
                    <div class="auth__link">
                        <p>Нет аккаунта? — <a href="{{ route('register') }}" class="highlight-red">Зарегистрироваться</a></p>
                    </div>
                </div>
                <form action="{{ route('login.store') }}" method="POST" class="auth__form">
                    @csrf
                    <div class="form__group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email">
                    </div>
                    <div class="form__group">
                        <label for="password">Пароль</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <div class="form__group">
                        <button type="submit" class="form__btn btn">Войти</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection
