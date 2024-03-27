@extends('layots.main')
@section('content')

<header>

   <div class="row">

      <h1>Войти</h1>

</header>

<section>
   <div class="section_main">

      <div class="row">

         <section class="eight columns">
            @isset($reg)
            <p style='color:green'>{{ $reg }}</p>
            @endisset


            <form method="POST" action="{{ route('kurs.storeAuth') }}">
               @csrf
               <p>Логин
                  <input name="login" type="text" value="{{ old('login') }}">
               </p>

               @error('login')
               <p style='color:red'>{{ $message }}</p>
               @enderror

               <p>Пароль
                  <input name="password" type="password" value="{{ old('password') }}">
               </p>

               @error('password')
               <p style='color:red'>{{ $message }}</p>
               @enderror

               <p><button type="submit">Войти</button></p>
            </form>
         </section>
      </div>
   </div>
</section>
@endsection