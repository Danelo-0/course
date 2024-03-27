<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Сourse extends Model
{
    use HasFactory;
    protected $table = 'сourses';
    protected $fillable=['title','content','category','places','date','time','image'];
}
