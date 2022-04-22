<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class StudentInfo extends Model
{
    protected $table = 'student_info';
    protected $fillable = [
        'name',
        'email',
        'gender',
        'mobile',
        'class',
        'education_year',
        'address',
        'photo',
        'status',
    ];



}
