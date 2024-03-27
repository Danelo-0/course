<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Сourse;
use App\Models\User;
use App\Models\Record;
use App\Http\Requests\AddCourseRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index()
    {
        $courses = Сourse::all();
        return view('index')->with(['courses' => $courses]);
    }

    public function showCategory($category)
    {
        $courses = Сourse::where('category', $category)->get();
        return view('category')->with(['courses' => $courses, 'category' => $category]);
    }

    public function showСourse($category, $course_id)
    {
        $course = Сourse::find($course_id);
        $date = Carbon::today();
        $check = true;
        $messeng = null;
        //dd(Record::where('id_user', 2)->where('id_course', 1)->exists());
        //dd(Record::where('id_user', 2)->get());
        //dd($course->date);
        if(Auth::check())
        {
            if(Record::where('id_user', Auth::user()->id)->where('id_course', $course_id)->exists())
            {
                $check = false;
            }
        }

        if($date > $course->date)
        {
            $messeng = "Курс уже начался. Вы не можете записаться и отписаться от курса";
        }
        //dd($messeng);
        return view('kurs')->with(['course' => $course, 'title' => $category, 'check' => $check, 'messeng'=> $messeng ]);
    }

    public function creat()
    {
        $images = Storage::disk('images')->files();
        return view('add')->with(['images' => $images]);
    }

    public function store(AddCourseRequest $request)
    {
        Сourse::create($request->all());
        return redirect()->route('kurs.showCategory', $request['category']);
    }

    public function delete($course_id)
    {
        $course = Сourse::find($course_id);
        $category = $course->category;
        $course->delete();
        return redirect()->route('kurs.showCategory', $category);
    }

    public function filter()
    {
        $date = request()->validate([
            'filter' => 'required',
        ]);
        //dd($date['filter']);
        if ($date['filter'] == 'Все') {
            $courses = Сourse::all();
            return view('index')->with(['courses' => $courses]);
        } elseif ($date['filter'] == 'Активные') {
            $time = Carbon::today();
            //dd($fd);
            $courses = Сourse::where('date', '>', $time)->get();
            //dd($courses);
            return view('index')->with(['courses' => $courses]);
        } elseif ($date['filter'] == 'Прошедшие') {
            $time = Carbon::today();
            $courses = Сourse::where('date', '<', $time)->get();
            //dd($courses);
            return view('index')->with(['courses' => $courses]);
        } elseif ($date['filter'] == 'Нет места') {
            $courses = Сourse::whereColumn('places', '=', 'records')->get();
            //dd($courses);
            return view('index')->with(['courses' => $courses]);
        }
    }

    public function profileShow()
    {
        $user = Auth::user();
        $courses = Сourse::all();
        $records = Record::where('id_user', $user->id)->get();
        return view('profile')->with(['user' => $user, 'title' => 'Личный кабинет', 'courses' => $courses, 'records' => $records]);;
    }

    public function authCreat()
    {

        return view('auth');
    }

    public function authStore(LoginRequest $request)
    {

        //dd($request->login);

        if (Auth::attempt($request->only('login', 'password'))) {
            if (Auth::user()->status == 'user') {
                //dd(Auth::user()->id);
                return redirect()->route('kurs.profile');
            } elseif (Auth::user()->status == 'admin') {
                return redirect()->route('kurs.showCategory', 'Английский');
            }
        }

        //dd(Auth::user());

        return back()->withInput()->withErrors(
            [
                'login' => 'Неверные данные пользователя. Проверте логин или пароль.',
            ]
        );
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('kurs.index');
    }

    public function registrationCreat()
    {
        return view('registration');
    }

    public function registrationStore(RegistrationRequest $request)
    {
        $path = null;

        if ($request->file('image') != null) {
            $path = $request->file('image')->store('uploads', 'images');
        }

        //dd($path);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'login' => $request->login,
            'password' => Hash::make($request->password),
            'image' => $path,
        ]);

        return view('auth')->with(['reg' => 'Вы были успешно зарегестрированны. Войдите в аккаунт.']);
    }

    public function courseEnrollment(Request $request)
    {
        //dd($request->id_course);
        Record::create([
            'id_user' => $request->id_user,
            'id_course' => $request->id_course,
        ]);

        Сourse::find($request->id_course)->increment('records');

        return back();
    }

    public function unsubscribeCourse(Request $request)
    {
        Record::where('id_user', $request->id_user)->where('id_course', $request->id_course)->delete();
        Сourse::find($request->id_course)->decrement('records');
        return back();
    }
}