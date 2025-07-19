@extends('../Components/layout')

@section('header')
    @include('../Components/header')
@endsection

@section('content')
    <main class="catalog__page">

        <section class="catalog__container container">
            <div class="catalog__menu">
                <h2>Фильтр</h2>
                <nav class="catalog__nav">
                    <a href="{{ route('catalog.filter', 'PHP') }}" class="catalog__nav-item">
                        <img src="/images/main/catalog/php-logo.svg" class="catalog__nav-item--image" alt="">
                        <span>PHP</span>
                    </a>
                    <a href="{{ route('catalog.filter', 'Laravel') }}" class="catalog__nav-item">
                        <img src="/images/main/catalog/laravel-logo.svg" class="catalog__nav-item--image" alt="">
                        <span>Laravel</span>
                    </a>
                </nav>
            </div>
            <div class="catalog__content">
                <h2>Курсы</h2>
                <div class="catalog__list">
                    @foreach($courses as $course)
                        <a href="{{ route('courses.show', $course) }}" class="catalog__course-link">
                            <div class="catalog__course">
                                <div class="course__content">
                                    <div class="course__title">
                                        {{ $course->title }}
                                    </div>
                                    <div class="course__description">
                                        {{ $course->description }}
                                    </div>
                                    <div class="course__price">
                                        {{ $course->price }}
                                    </div>
                                </div>
                                <div class="course__actions">
                                    @auth
                                        <form action="{{ route('courses.favorite.toggle', ['course' => $course->id]) }}" method="POST">
                                            @csrf
                                            <button class="course__action-favorite"
                                                    data-course-id="{{ $course->id }}"
                                                    data-is-favorite="{{ isset($isFavorite[$course->id]) && $isFavorite[$course->id] ? 'true' : 'false' }}">
                                                <svg width="25" height="22" viewBox="0 0 25 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M23.2222 7.51358C23.2222 9.23189 22.5625 10.8823 21.3842 12.1032C18.6721 14.9144 16.0416 17.8459 13.2281 20.5552C12.5832 21.1672 11.5602 21.1449 10.9431 20.5052L2.83751 12.1032C0.387497 9.56355 0.387497 5.46359 2.83751 2.92397C5.3116 0.359389 9.34216 0.359389 11.8162 2.92397L12.1109 3.22936L12.4053 2.92414C13.5916 1.69389 15.2071 1 16.8948 1C18.5824 1 20.1979 1.69382 21.3842 2.92397C22.5626 4.14494 23.2222 5.7953 23.2222 7.51358Z"
                                                          stroke="{{ isset($isFavorite[$course->id]) && $isFavorite[$course->id] ? 'red' : '#acacac' }}"
                                                          fill="{{ isset($isFavorite[$course->id]) && $isFavorite[$course->id] ? 'red' : 'none' }}"
                                                          stroke-width="2"
                                                          stroke-linejoin="round"
                                                          class="heart-path"
                                                    />
                                                </svg>
                                            </button>
                                        </form>
                                    @endauth
                                    <button class="course__action-button btn">Подробнее</button>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

    </main>
    <script src="/js/favorite.js"></script>
@endsection
