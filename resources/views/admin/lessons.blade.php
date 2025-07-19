@extends('../Components/layout')

@section('header')
    @include('../Components/admin-header')
@endsection

@section('content')
    <main class="admin-panel">
        <div class="container course-list">
            <h1>Уроки курса "{{ $course->title }}"</h1>

            @if (session('success'))
                <div class="alert">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('lessons.create', $course) }}" class="lessons-link add-lesson-button">Добавить урок</a>

            <table class="styled-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($lessons as $lesson)
                    <tr>
                        <td>{{ $lesson->id }}</td>
                        <td>{{ $lesson->title }}</td>
                        <td>
                            <div class="course-actions">
                                <form action="{{ route('lessons.destroy', [$course, $lesson]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Вы уверены?')" class="delete-button">Удалить</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
