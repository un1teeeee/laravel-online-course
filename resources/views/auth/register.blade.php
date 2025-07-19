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
                        <p>От новичка до профессионала за пару кликов! Зарегистрируйтесь
                            и начните свой путь к созданию крутых веб-проектов</p>
                    </div>
                    <div class="auth__link">
                        <p>Есть аккаунт? — <a href="{{ route('login') }}" class="highlight-red">Войти</a></p>
                    </div>
                </div>

                <form action="{{ route('register.store') }}" method="POST" class="auth__form">
                    @csrf

                    <div class="form__group">
                        <label for="name">Имя</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}">
                        @error('name')
                        <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form__group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="{{ old('email') }}">
                        @error('email')
                        <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form__group">
                        <label for="password">Пароль</label>
                        <input type="password" name="password" id="password" >
                        @error('password')
                        <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form__group">
                        <label for="password_confirmation">Повторите пароль</label>
                        <input type="password" name="password_confirmation" id="password_confirmation">
                    </div>

                    <div class="form__group">
                        <button type="submit" class="form__btn btn">Зарегистрироваться</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection
