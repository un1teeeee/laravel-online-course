@extends('../Components/layout')

@section('header')
    @include('../Components/header')
@endsection

@section('content')
    <main class="lesson__page">
        <div class="container">
            <h1 class="title">О нас - DevCamp</h1>

            <section class="section">
                <h2 class="section-title">Добро пожаловать в DevCamp!</h2>
                <p class="section-description">
                    DevCamp – это ваш надежный партнер в мире PHP и Laravel разработки. Мы предлагаем качественные онлайн-курсы, разработанные опытными профессионалами, чтобы помочь вам освоить эти востребованные технологии и достичь успеха в карьере веб-разработчика.
                </p>
            </section>

            <section class="section">
                <h3 class="section-subtitle">Наша миссия</h3>
                <p class="section-description">
                    Мы стремимся предоставить доступное и эффективное обучение, которое позволит каждому, независимо от уровня подготовки, стать уверенным и востребованным PHP/Laravel разработчиком. Мы верим, что качественное образование – это ключ к успеху в современном мире технологий.
                </p>
            </section>

            <section class="section">
                <h3 class="section-subtitle">Почему выбирают нас?</h3>
                <ul class="list">
                    <li class="list-item">
                        <strong>Практическая направленность:</strong> Наши курсы основаны на реальных проектах и задачах, с которыми вы столкнетесь в работе.
                    </li>
                    <li class="list-item">
                        <strong>Опытные преподаватели:</strong> Наши инструкторы – это практикующие разработчики с многолетним опытом, готовые поделиться своими знаниями и опытом.
                    </li>
                    <li class="list-item">
                        <strong>Современные методики обучения:</strong> Мы используем современные подходы к обучению, чтобы сделать процесс обучения максимально эффективным и интересным.
                    </li>
                    <li class="list-item">
                        <strong>Поддержка и сообщество:</strong> Вы получите поддержку от наших преподавателей и других студентов в нашем активном онлайн-сообществе.
                    </li>
                    <li class="list-item">
                        <strong>Гибкий график:</strong> Учитесь в удобное для вас время и в своем темпе.
                    </li>
                </ul>
            </section>

            <section class="section">
                <h3 class="section-subtitle">Что вы получите, обучаясь у нас?</h3>
                <ul class="list">
                    <li class="list-item">Глубокое понимание основ PHP и Laravel.</li>
                    <li class="list-item">Практические навыки разработки веб-приложений.</li>
                    <li class="list-item">Умение работать с базами данных MySQL.</li>
                    <li class="list-item">Навыки использования шаблонизатора Blade.</li>
                    <li class="list-item">Опыт работы с Composer и другими современными инструментами.</li>
                    <li class="list-item">Подготовку к реальным проектам и задачам в веб-разработке.</li>
                </ul>
            </section>

            <section class="section">
                <h3 class="section-subtitle">Наша команда</h3>
                <p class="section-description">
                    Мы – команда увлеченных профессионалов, которые любят PHP и Laravel и хотят поделиться своей страстью с вами.
                </p>
            </section>

            <section class="section">
                <p class="section-description">
                    <strong>Присоединяйтесь к DevCamp и начните свой путь к успешной карьере PHP/Laravel разработчика!</strong>
                </p>
            </section>
        </div>
    </main>
@endsection

