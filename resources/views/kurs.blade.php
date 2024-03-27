@extends('layots.courseAndProfile')
@section('content')

<header>

  <div class="row">
    <h4> </h4>
    <article>

      <div class="twelve columns">
        <h1>{{ $course->title }}</h1>
        <p class="excerpt">
          Начало курса: <b>{{$course->date}}, {{$course->time}}</b>.
        </p>
        <p class="excerpt">
          Записанно на курс: <b>{{ $course->records }} из {{ $course->places }}</b>.
        </p><br>
        @can('viewLogout')
        @cannot('admin')
        @if($messeng == null)
        @if($check)
        @if($course->records < $course->places)
        <a href="#" onclick="event.preventDefault();
        document.getElementById('enrollment{{ $course->id }}').submit();">
          Записатсья на курс
        </a>
        <form id="enrollment{{ $course->id }}" action="{{ route('kurs.enrollment', ['$course->category', '$course->id']) }}" method="POST" style="display: none;">
          @csrf
          <input name = 'id_user' type = 'text' value = "{{ Auth::user()->id }}">
          <input name = 'id_course' type = 'number' value = "{{ $course->id }}">
        </form><br>
        @else
        <p style = 'color:red'>Места для записи на курс закончились</p>
        @endif
        @else
        <a style = "color:red" href="#" onclick="event.preventDefault();
        document.getElementById('unsubscribe{{ $course->id }}').submit();">
          Отписатсья от курса
        </a>
        <form id="unsubscribe{{ $course->id }}" action="{{ route('kurs.unsubscribe', ['$course->category', '$course->id']) }}" method="POST" style="display: none;">
          @csrf
          @method('delete')
          <input name = 'id_user' type = 'text' value = "{{ Auth::user()->id }}">
          <input name = 'id_course' type = 'number' value = "{{ $course->id }}">
        </form><br>
        @endif
        @else 
        <p style = 'color:red'>{{ $messeng }}</p>
        @endif
  
        @endcannot 
        @endcan
      </div>


    </article>


  </div>

</header>

<!-- ######################## Section ######################## -->

<section class="section_light">

  <div class="row">

    <p> <img src="{{ asset('images/'. $course->image) }}" alt="desc" width=400 align=left hspace=30>{{ $course->content }}</p>

  </div>

  @endsection