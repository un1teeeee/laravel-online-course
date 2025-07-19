@extends('../Components/layout')

@section('header')
    @include('../Components/admin-header')
@endsection

@section('content')
    <main class="admin-panel">
        <div class="container add-course-form">
            <h1>Добавить курс</h1>

            <form action="{{ route('courses.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="title">Название:</label>
                    <input type="text" id="title" name="title" required>
                </div>

                <div class="form-group">
                    <label for="description">Описание:</label>
                    <textarea id="description" name="description"></textarea>
                </div>

                <div class="form-group">
                    <label for="price">Цена:</label>
                    <input type="text" id="price" name="price" required>
                </div>

                <div class="form-group">
                    <label for="prog_language">Язык программирования:</label>
                    <select id="prog_language" name="prog_language" required>
                        <option value="PHP">PHP</option>
                        <option value="Laravel">Laravel</option>
                    </select>
                </div>

                <button type="submit">Сохранить</button>
            </form>
        </div>

        <div class="container course-list">
            <h1>Список курсов</h1>

            @if (session('success'))
                <div class="alert">
                    {{ session('success') }}
                </div>
            @endif

            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Цена</th>
                    <th>Язык</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <td>{{ $course->id }}</td>
                        <td>{{ $course->title }}</td>
                        <td>{{ $course->description }}</td>
                        <td>{{ $course->price }}</td>
                        <td>{{ $course->prog_language }}</td>
                        <td>
                            <div class="course-actions">
                                <a href="{{ route('lessons.index', ['course' => $course->id]) }}" class="lessons-link">Уроки</a>
                                <form action="{{ route('courses.destroy', $course) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Вы уверены?')">Удалить</button>
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
