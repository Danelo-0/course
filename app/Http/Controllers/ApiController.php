<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use Illuminate\Http\Request;
use App\Models\Сourse;

class ApiController extends Controller
{
    public function index()
    {
        return dd(CourseResource::collection(Сourse::all())->toJson(JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }

    public function show($id)
    {
        return dd(json_encode(new CourseResource(Сourse::findOrFail($id)), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }
}
