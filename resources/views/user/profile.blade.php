@extends('../Components/layout')

@section('header')
    @include('../Components/header')
@endsection

@section('content')
    <main class="profile__page">
        <section class="profile__container container">
            <div class="profile__content">
                <div class="profile__user">
                    <div class="profile__avatar">
                        <img src="/images/profile/avatar.avif" alt="Аватарка" class="profile__avatar-image">
                    </div>
                    <div class="profile__flex">
                        <div class="profile__info">
                            <div class="profile__info-item">
                                <span class="profile__info-label">Имя:</span>
                                <span class="profile__info-value">{{ Auth::user()->name }}</span>
                            </div>
                            <div class="profile__info-item">
                                <span class="profile__info-label">Email:</span>
                                <span class="profile__info-value">{{ Auth::user()->email }}</span>
                            </div>
                        </div>
                        <div class="profile__actions">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="profile__action-button btn">Выйти</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="profile__menu">
                    <nav class="profile__nav">
                        <a href="#" class="profile__nav-item {{ $activeMenu == 'progress' ? 'active' : '' }}" data-content="progress">
                            Прогресс
                        </a>
                        <a href="#" class="profile__nav-item {{ $activeMenu == 'favorites' ? 'active' : '' }}" data-content="favorites">
                            Избранное
                        </a>
                    </nav>
                </div>

                <div id="progress-content" class="profile__dynamic-content active">
                    @if (count($courses) > 0)

                        <div class="catalog__list">
                            @foreach ($courses as $course)
                                <div class="profile-catalog__course">
                                    <div class="course__progress">
                                        <div class="progress-bar-container">
                                            @php
                                                $progressValue = round($progress[$course->id]);
                                            @endphp
                                            <div class="progress-bar" style="width: {{ $progressValue }}%;">
                                                <span class="progress-text">{{ $progressValue }}%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="course__about">
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
                                            <div class="course-item__action">
                                                <a href="{{ route('lessons.show', $course->lessons()->orderBy('created_at', 'asc')->first()) }}"><button class="course-item__action-button btn">Продолжить</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>Вы еще не записались ни на один курс.</p>
                    @endif
                </div>
                <div id="favorites-content" class="profile__dynamic-content">
                    <div class="catalog__list">
                        @foreach($favorites as $favorite)
                            <div class="catalog__course">
                                <div class="course__content">
                                    <div class="course__title">
                                        {{ $favorite->course->title }}
                                    </div>
                                    <div class="course__description">
                                        {{ $favorite->course->description }}
                                    </div>
                                    <div class="course__price">
                                        {{ $favorite->course->price }}
                                    </div>
                                </div>
                                <div class="course__actions">
                                    @auth
                                        <form action="{{ route('courses.favorite.toggle', ['course' => $favorite->course->id]) }}" method="POST">
                                            @csrf
                                            <button class="course__action-favorite"
                                                    data-course-id="{{ $favorite->course->id }}"
                                                    data-is-favorite="{{ isset($isFavorite[$favorite->course->id]) && $isFavorite[$favorite->course->id] ? 'true' : 'false' }}">
                                                <svg width="25" height="22" viewBox="0 0 25 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M23.2222 7.51358C23.2222 9.23189 22.5625 10.8823 21.3842 12.1032C18.6721 14.9144 16.0416 17.8459 13.2281 20.5552C12.5832 21.1672 11.5602 21.1449 10.9431 20.5052L2.83751 12.1032C0.387497 9.56355 0.387497 5.46359 2.83751 2.92397C5.3116 0.359389 9.34216 0.359389 11.8162 2.92397L12.1109 3.22936L12.4053 2.92414C13.5916 1.69389 15.2071 1 16.8948 1C18.5824 1 20.1979 1.69382 21.3842 2.92397C22.5626 4.14494 23.2222 5.7953 23.2222 7.51358Z"
                                                          stroke="{{ isset($isFavorite[$favorite->course->id]) && $isFavorite[$favorite->course->id] ? 'red' : '#acacac' }}"
                                                          fill="{{ isset($isFavorite[$favorite->course->id]) && $isFavorite[$favorite->course->id] ? 'red' : 'none' }}"
                                                          stroke-width="2"
                                                          stroke-linejoin="round"
                                                          class="heart-path"
                                                    />
                                                </svg>
                                            </button>
                                        </form>
                                    @endauth

                                        @php
                                            $isEnrolled = App\Models\CourseUser::where('user_id', Auth::id())
                                                ->where('course_id', $course->id)
                                                ->exists();
                                        @endphp

                                        @if(Auth::check() && $isEnrolled)
                                            @if($course->lessons->count() > 0)
                                                <div class="course-item__action">
                                                    <a href="{{ route('lessons.show', $course->lessons()->orderBy('created_at', 'asc')->first()) }}"><button class="course-item__action-button btn">Продолжить</button></a>
                                                </div>
                                            @endif
                                        @else
                                            <div class="course-item__action">
                                                <form action="{{ route('enrollment.enrollAndRedirect', $course) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="course-item__action-button btn">Записаться</button>
                                                </form>
                                            </div>
                                        @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </section>
    </main>

    <script src="/js/profile-menu.js"></script>
    <script src="/js/favorite.js"></script>
@endsection

