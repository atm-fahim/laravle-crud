<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentValidationRequest;
use App\Repository\StudentInfoRepository;
use App\Service\StudentInfoService;
//use Image;
//use Illuminate\Http\Request;
//use App\Models\StudentInfo;
//use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Validator;

class StudentInfoController extends Controller
{

    protected $studentInfoRepository;
    protected $studentInfoService;

    public function __construct(StudentInfoRepository $studentInfoRepository,StudentInfoService $studentInfoService)
    {
        $this->studentInfoRepository = $studentInfoRepository;
        $this->studentInfoService = $studentInfoService;
    }

    public function index()
    {
        $students = $this->studentInfoRepository->getStudents();
        return  view('student',compact('students'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */


    public function store(StudentValidationRequest $request)
    {
        try {
            $student = $this->studentInfoService->save($request);
            return response()->json([
                'success' => true,
                'message' => 'Student added successfully.',
                'data' => $student
            ], 200);

        }catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

}
