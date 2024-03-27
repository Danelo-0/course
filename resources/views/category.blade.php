@extends('layots.main')
@section('content')

<header>

    <div class="row">

        <h1>{{ $category }}</h1>

</header>

<section>

    <div class="section_main">

        <div class="row">

            <section class="eight columns">
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
                        @can('admin')
                        @if($course->records == 0)
                        <a href="#" onclick="event.preventDefault();
                        document.getElementById('deleteForm{{ $course->id }}').submit();">
                            Удалить
                        </a>

                        <form id="deleteForm{{ $course->id }}" action="{{ route('kurs.delete', $course->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('delete')
                        </form><br>
                        @else
                        <p style = 'color:red'>Данный курс нельзя удалить, так как на него уже есть запись.</p>
                        @endif
                        @endcan
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
            @can('admin')
            <section class="four columns">
                <H3> &nbsp; </H3>
                <div class="panel">
                    <h3>Админ-панель</h3>

                    <ul class="accordion">
                        <li class="active">
                            <div class="title">
                                <a href="{{ route('kurs.creat') }}">
                                    <h5>Добавить курс</h5>
                                </a>
                            </div>

                        </li>
                    </ul>

                </div>
            </section>
            @endcan
        </div>

    </div>

</section>
@endsection