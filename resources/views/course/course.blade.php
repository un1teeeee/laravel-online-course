@extends('../Components/layout')

@section('header')
    @include('../Components/header')
@endsection

@section('content')

    <main class="course__page">

        <div class="course__container container">
            <div class="course-item__title">
                {{ $course->title }}
            </div>

            <div class="course-item__info">
                <div class="catalog__content">
                    <h2>О курсе</h2>
                    <div class="course-item__description">
                        {{ $course->description }}
                    </div>

                    <h2>Уроки</h2>
                    <div class="course-item__description">
                        <ul class="course-lessons">
                            @foreach($course->lessons as $lesson)
                                <li class="course-lesson">
                                    <a href="{{ route('lessons.show', $lesson) }}" class="course-lesson__link">{{ $lesson->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="course-item__menu">
                    <div class="course-item__actions">
                        <div class="course-item__price">
                            {{ $course->price }}
                        </div>

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
                            <div class="course-item__action">
                                <form action="{{ route('enrollment.unenroll', $course) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="course-item__action-button btn btn-danger">Отписаться</button>
                                </form>
                            </div>
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
            </div>
        </div>

    </main>

@endsection
