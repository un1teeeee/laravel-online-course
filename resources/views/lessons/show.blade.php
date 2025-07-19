@extends('../Components/layout')

@section('header')
    @include('../Components/header')
@endsection

@section('content')
    <main class="lesson__page">
        <div class="lesson__container container">
            <div class="catalog__menu">
                <h2>Уроки</h2>
                <nav class="lesson__nav">
                    @foreach($lessons as $otherLesson)
                        <a href="{{ route('lessons.show', $otherLesson) }}"
                           class="lesson__nav-item {{ $otherLesson->id == $lesson->id ? 'lesson__nav-item--active' : '' }}">
                            {{ $otherLesson->title }}
                        </a>
                    @endforeach
                </nav>
            </div>

            <div class="lesson__about">
                <h1>{{ $lesson->title }}</h1>
                <div class="lesson__info">
                    <p class="lesson__description">{{ $lesson->content }}</p>

                    <form action="{{ route('lessons.complete', $lesson) }}" method="POST">
                        @csrf
                        <button type="submit" class="lesson__action-button btn">Следующий урок</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

@endsection
