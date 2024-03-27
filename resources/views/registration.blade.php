@extends('layots.main')
@section('content')

<header>

   <div class="row">

      <h1>Регистрация</h1>

</header>

<section>
   <div class="section_main">

      <div class="row">

         <section class="eight columns">


            <form method="POST" action="{{ route('kurs.storeRegistration') }}" enctype="multipart/form-data">
               @csrf
               <p>ФИО
                  <input name="name" type="text" value="{{ old('name') }}">
               </p>

               @error('name')
               <p style='color:red'>{{ $message }}</p>
               @enderror

               <p>E-mail 
                  <input name="email" type="text" value="{{ old('email') }}">
               </p>

               @error('email')
               <p style='color:red'>{{ $message }}</p>
               @enderror

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

               <p>Потверждение пароля
                  <input name="password_confirmation" type="password" value="{{ old('password_confirmation') }}">
               </p>

               @error('password_confirmation')
               <p style='color:red'>{{ $message }}</p>
               @enderror

               <p>Аватар
                  <input name="image" type="file" value="{{ old('image') }}">
               </p>

               @error('image')
               <p style='color:red'>{{ $message }}</p>
               @enderror
              
               <p><button type="submit">Зарегестрироваться</button></p>
            </form>
         </section>
      </div>
   </div>
</section>
@endsection