@extends('layots.courseAndProfile')
@section('content')

<header>

  <div class="row">
    <h4> </h4>
    <article>
      <div class="row">
        @if($user->image != null)
        <p> <img src="{{ asset('images/'. $user->image) }}" alt="desc" width=400 align=left hspace=30></p>
        @else
        <p> <img src="{{ asset('images/prod_thumb.png') }}" alt="desc" width=400 align=left hspace=30></p>
        @endif
      </div>

      <div class="twelve columns">
        <h1>{{ $user->name }}</h1>
      </div>

    </article>


  </div>

</header>

<!-- ######################## Section ######################## -->

<section class="section_light">
<h1>Ваши курсы</h1>
  @if(count($records) !=0)
  @foreach($records as $record)
  <article class="blog_post">

    <div class="three columns">
      <a href="{{ route('kurs.showСourse', [$courses->find($record->id_course)->category, $courses->find($record->id_course)->id]) }}" class="th"><img src="{{ asset('images/'. $courses->find($record->id_course)->image) }}" alt="Нет картинки" /></a>
    </div>
    <div class="nine columns">
      <a href="{{ route('kurs.showСourse', [$courses->find($record->id_course)->category, $courses->find($record->id_course)->id]) }}">
        <h4>{{ $courses->find($record->id_course)->title }}</h4>
      </a>
      <p>{{ $courses->find($record->id_course)->content }}</p>
      <p>Дата: {{ $courses->find($record->id_course)->date }}</p>

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
        <h4>Вы не записаны на курсы</h4>
      </a>
      <p></p>

    </div>

  </article>
  @endif
</section>

@endsection