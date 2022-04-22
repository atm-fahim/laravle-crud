<?php

namespace App\Service;
use App\Repository\StudentInfoInterface;
use App\Service\StudentInfoService;


class StudentInfoServiceImplementation implements StudentInfoService
{

    protected $studentInfo;

    /**
     * @param StudentInterface $studentInfo
     */
    public function __construct(StudentInfoInterface $studentInfo)
    {
        $this->studentInfo = $studentInfo;
    }

    public function save($request)
    {

        $data = [
            'name' => $request['name'],
            'gender' => $request['gender'],
            'email' => $request['email'],
            'mobile' => $request['mobile'],
            'class' => $request['class'],
            'year' => $request['year'],
            'address' => $request['address']
        ];
        return $this->studentInfo->save($data);
    }
}
