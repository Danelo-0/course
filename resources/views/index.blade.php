@extends('layots.main')
@section('content')

<header>

    <div class="row">

        <h1>Языковая школа LINGVO</h1>

</header>

<section>

    <div class="section_main">

        <div class="row">
            <section class="eight columns">
                <form method="POST" action="{{ route('kurs.filter')}}">
                    @csrf
                    <p>Фильтр
                        <select name="filter">
                            <option selected value="Все">Все</option>
                            <option value="Активные">Активные</option>
                            <option value="Прошедшие">Прошедшие</option>
                            <option value="Нет места">Нет места</option>
                        </select>
                    </p>
                    <button type="submit">Применить фильтр</button>
                </form>
                @if(count($courses) !=0)
                @foreach($courses as $course)
                <article class="blog_post">

                    <div class="three columns">
                        <a href="{{ route('kurs.showСourse', [$course->category, $course->id]) }}" class="th"><img src="{{ asset('images/'. $course->image) }}" alt="Нет картинки" /></a>
                    </div>
                    <div class="nine columns">
                        <a href="{{ route('kurs.showСourse', [$course->category, $course->id]) }}">
                            <h4>{{ $course->title }}</h4>
                        </a>
                        <p>{{ $course->content }}</p>
                        <p>Записей на курс: {{$course->records}} из {{$course->places}}</p>
                        <p>Дата: {{ $course->date }}</p>

                    </div>

                </article>
                @endforeach
                @else
                <article class="blog_post">

                    <div class="three columns">
                        <a href="#" class="th"><img src="{{ asset('images/prod_thumb.png') }}" alt="Нет картинки" /></a>
                    </div>
                    <div class="nine columns">
                        <a href="#">
                            <h4>Курсы данной категории отсутствуют.</h4>
                        </a>
                        <p></p>

                    </div>

                </article>
                @endif
            </section>

        </div>

    </div>

</section>
@endsection