<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentValidationRequest;
use App\Model\PaymentMethodLogModel;
use Image;
use Illuminate\Http\Request;
use App\Models\StudentInfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Repository\StudentInfoInterface;
use App\Service\StudentInfoService;

class StudentInfoTwoController extends Controller
{

    protected $studentInfo;
    protected $studentInfoService;
    //
    public function __construct(StudentInfoInterface $studentInfo, StudentInfoService $studentInfoService)
    {
        $this->studentInfo = $studentInfo;
        $this->studentInfoService = $studentInfoService;

    }

    public function addStudentInfo()
    {
        $all_student_info =$this->studentInfo->getStudents();
        return  view('student')->with('all_student_info', $all_student_info);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */


    public function store(StudentValidationRequest $request)
    {
            try {
                $id = $request->input('id');

                if (isset($id) && !empty($id)) {
                    $studentInfo = StudentInfo::find($id);
                } else {

                    $studentInfo = new StudentInfo();
                }
                $this->studentInfoService->save($request->except('token'));



//                $image = $request->file('photo');
//                if (isset($image) && !empty($image)) {
//                    $input['photo'] = time() . '.' . $image->getClientOriginalExtension();
//                    if (!file_exists(public_path('uploads/photo/'))) {
//                        mkdir(public_path('uploads/photo/'), 0777, true);
//                    }
//                    $destinationPath = public_path('uploads/photo');
//                    // $destinationPath = public_path('thumbnail');
//                    $img = Image::make($image->getRealPath());
//                    $success = $img->resize(1300, 130, function ($constraint) {
//                        $constraint->aspectRatio();
//                    })->save($destinationPath . '/' . $input['photo']);
//
//                    $destPath = 'uploads/photo';
//
//                    if ($success) {
//                        $studentInfo->photo = $destPath . '/' . $input['photo'];
//                    } else {
//                        $studentInfo->photo = $request->input('photo1');
//                    }
//                }
                //you using save or update laravel function
                $studentInfo->save();

                if (isset($id) && !empty($id)) {
                    Session::flash('message', 'Update Successfully !');
                    Session::flash('activetab', 'tb');
                } else {
                    Session::flash('message', 'Save Successfully !');
                    Session::flash('activetab', 'tb');
                }
            } catch (\Exception $e) {
                echo $e;
            }

        return redirect('banner');
    }

    //=======================
    //edit type

    public function edit_slider_banner($id = NULL)
    {
        $mtbanner = SliderBannerMode::find($id);
        echo json_encode($mtbanner);
    }

    public function publish_slider_banner($id)
    {
        $order = SliderBannerMode::find($id);
        $order->PUBLISHSTS = 1;
        $order->save();
        Session::flash('activetab', 'sld');
        return redirect('banner');
    }

    public function unpublish_slider_banner($id)
    {
        //echo $id;exit;
        $order = SliderBannerMode::find($id);
        $order->PUBLISHSTS = 0;
        $order->save();
        Session::flash('activetab', 'sld');
        return redirect('banner');
    }

    public function delete_slider_banner($id)
    {
        $order = SliderBannerMode::find($id);
        $order->PUBLISHSTS = 9;
        $order->save();
        Session::flash('activetab', 'sld');
        return redirect('banner');
    }

    //=======================
}
