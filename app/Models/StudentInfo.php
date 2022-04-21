<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class StudentInfo extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * @id primarykey
     */
    protected $table = "student_info";
    protected $primaryKey = "id";
    public $timestamps = true;
    public static $snakeAttributes = false;



}
