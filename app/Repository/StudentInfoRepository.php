<?php

namespace App\Repository;

use App\Models\StudentInfo;
use Illuminate\Support\Facades\DB;

class StudentInfoRepository implements StudentInfoInterface
{
    public function getStudents()
    {
        return StudentInfo::where('status', 1)->get();
    }

    public function save($data)
    {
      return StudentInfo::insert($data);
    }


}
