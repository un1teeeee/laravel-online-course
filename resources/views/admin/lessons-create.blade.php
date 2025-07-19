@extends('../Components/layout')

@section('header')
    @include('../Components/admin-header')
@endsection

@section('content')
    <main class="admin-panel">
        <div class="container add-course-form">
            <h1>Добавить урок для курса "{{ $course->title }}"</h1>

            <form action="{{ route('lessons.store', $course) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="title">Название:</label>
                    <input type="text" id="title" name="title" required>
                </div>

                <div class="form-group">
                    <label for="content">Контент:</label>
                    <textarea id="content" name="content" rows="5" required></textarea>
                </div>

                <button type="submit" class="save-button">Сохранить</button>
            </form>
        </div>
    </main>
@endsection
