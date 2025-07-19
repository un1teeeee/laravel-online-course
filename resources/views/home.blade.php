@extends('../Components/layout')

@section('header')
    @include('../Components/header')
@endsection

@section('content')
    <main>
        <section class="welcome">
            <div class="welcome__container container">
                <div class="welcome__title">
                    <h1 class="welcome__heading display-4 typing"></h1>
                </div>

                <div class="welcome__description">
                    <p class="welcome__lead">Хватит читать теорию! Начни создавать <span class="highlight-red">реальные проекты</span> на <span class="highlight-red">PHP и Laravel</span> уже сегодня.</p>
                    <ul class="welcome__features">
                        <li><span class="welcome__feature-icon check-icon">&#10004;</span> <span class="highlight-red">Практические задания</span> с первых уроков</li>
                        <li><span class="welcome__feature-icon check-icon">&#10004;</span> Поддержка <span class="highlight-red">опытных менторов</span></li>
                        <li><span class="welcome__feature-icon check-icon">&#10004;</span> Готовые проекты в <span class="highlight-red">портфолио</span></li>
                    </ul>
                </div>

                <div class="welcome__actions">
                    <a href="{{ route('catalog') }}" class="welcome__action-button btn">Выбрать курс и начать учиться</a>
                </div>
            </div>
        </section>

        <section class="about">
            <div class="container">
                <div class="about__title">
                    <h2 class="about__heading">О нас</h2>
                    <hr class="about__title-hr">
                </div>

                <div class="about__description">
                    <span class="highlight-red">DevCamp</span> — это онлайн-платформа, где ты можешь освоить
                    <span class="highlight-red">PHP и Laravel</span> с нуля и прокачать свои навыки до профессионального уровня.
                    Обучение построено на реальных проектах и актуальных технологиях.
                </div>

                <div class="about__actions">
                    <a href="#" class="about__actions-btn btn">Подробнее</a>
                </div>
            </div>
        </section>

        <section class="advantages">
            <div class="advantages__container container">
                <h2 class="advantages__title">Преимущества нашего курса</h2>
                <div class="advantages__items">
                    <div class="advantages__item">
                        <div class="advantages__item-icon">
                            <img src="/images/main/promo/icon1.svg" alt="" class="advantages__item-image">
                        </div>
                        <h3 class="advantages__item-heading">Знаем, что идти вместе проще, чем в одиночку</h3>
                        <p class="advantages__item-description">Главное в наших курсах — люди: команда сопровождения, другие студенты и сообщество выпускников. Всегда найдётся тот, кто поддержит или даст совет</p>
                    </div>
                    <div class="advantages__item">
                        <div class="advantages__item-icon">
                            <img src="/images/main/promo/sfera_svgrepo.com.svg" alt="" class="advantages__item-image">
                        </div>
                        <h3 class="advantages__item-heading">Развиваемся вместе с IT-сферой</h3>
                        <p class="advantages__item-description">Мы постоянно обновляем наши курсы, чтобы вы могли осваивать актуальные и востребованные навыки. Это позволяет вам уверенно двигаться к своим целям.</p>
                    </div>
                    <div class="advantages__item">
                        <div class="advantages__item-icon">
                            <img src="/images/main/promo/analytics_svgrepo.com.svg" alt="" class="advantages__item-image">
                        </div>
                        <h3 class="advantages__item-heading">Верим в большие данные, а не в интуицию</h3>
                        <p class="advantages__item-description">Анализируем, как учатся студенты: где теряется мотивация, а что движет их вперёд. Так мы улучшаем курсы, чтобы вам было легче и интереснее</p>
                    </div>
                    <div class="advantages__item">
                        <div class="advantages__item-icon">
                            <img src="/images/main/promo/medal.svg" alt="" class="advantages__item-image">
                        </div>
                        <h3 class="advantages__item-heading">Обучение как Ключ к Успеху</h3>
                        <p class="advantages__item-description">В итоге — то, ради чего вы здесь. Новая профессия, навык, диплом, знакомства — наш подход в обучении поможет прийти к цели, какой бы она ни была.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="support">
            <div class="support__container container">
                <div class="support__title">
                    <h1 class="support__heading">Ответим на все ваши вопросы</h1>
                </div>
                <form action="{{ route('support.store') }}" method="post" class="support__form">
                    @csrf
                    <div class="form__group">
                        <label for="name">Имя</label>
                        <input type="text" id="name" name="name">
                    </div>
                    <div class="form__group">
                        <label for="phone">Телефон</label>
                        <input type="tel" id="phone" name="phone" min="11" max="12">
                    </div>
                    <div class="form__group">
                        <label for="email">Электронная почта</label>
                        <input type="email" id="email" name="email">
                    </div>
                    <div class="form__group">
                        <button type="submit" class="form__btn btn">Спросить</button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <script>
        const fullText = 'Стань <span class="highlight-red">Laravel-мастером</span> и создавай <span class="highlight-red">крутые</span> веб-приложения!';
        const heading = document.querySelector('.welcome__heading');


        heading.innerHTML = '';


        let i = 0;
        function type() {
            if (i < fullText.length) {
                heading.innerHTML = fullText.substring(0, i + 1);
                i++;
                setTimeout(type, 50);
            } else {
                heading.classList.remove('typing');
            }
        }

        type();
    </script>
@endsection
