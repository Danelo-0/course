@extends('layots.main')
@section('content')

<header>

   <div class="row">

      <h1>Добавление курса</h1>

</header>

<section>
   <div class="section_main">

      <div class="row">

         <section class="eight columns">


            <form method="POST" action="{{ route('kurs.store') }}">
               @csrf
               <p>Загаловок
                  <input name="title" type="text" value="{{ old('title') }}">
               </p>

               @error('title')
               <p style='color:red'>{{ $message }}</p>
               @enderror

               <p>Цель <textarea rows="10" cols="20" name="content">{{ old('content') }}</textarea></p>

               @error('content')
               <p style='color:red'>{{ $message }}</p>
               @enderror

               <p>Категория
                  <select name="category">
                     <option selected value="Английский">Английский</option>
                     <option value="Французский">Французский</option>
                     <option value="Немецкий">Немецкий</option>
                     <option value="Китайский">Китайский</option>
                  </select>
               </p>

               <p>Количество мест
                  <input name="places" type="number" value="{{ old('places') }}">
               </p>

               @error('places')
               <p style='color:red'>{{ $message }}</p>
               @enderror

               <p>Дата
                  <input name="date" type="date" value="{{ old('date') }}">
               </p>

               @error('date')
               <p style='color:red'>{{ $message }}</p>
               @enderror

               <p>Время
                  <input name="time" type="time" value="{{ old('time') }}">
               </p>

               @error('time')
               <p style='color:red'>{{ $message }}</p>
               @enderror


               <p>Картинка
                  <select name="image">
                     @foreach ($images as $img)
                     <option value="{{ $img }}">{{ $img }}</option>
                     @endforeach
                  </select>
               </p>

               <p><button type="submit">Добавить курс</button></p>
            </form>
         </section>
      </div>
   </div>
</section>
@endsection