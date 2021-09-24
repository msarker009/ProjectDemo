<?php

namespace App\Http\Controllers;

use App\Models\Student;
use http\Env\Response;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\validator;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
    public function index(){
        return view('student.index');
    }
    public function fetchStudent(){
        $students=Student::all();
        return response()->json([
            'students'=>$students,
        ]);
    }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required|max:191',
            'email'=>'required|email|max:191',
            'phone'=>'required|max:12',
            'course'=>'required|max:191',
            'image'=>'required|mimes:jpeg,jpg,png,gif|max:2048',
        ]);
        if ($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }
        else
        {
            $students=new Student();
            $students->name=$request->input('name');
            $students->email=$request->input('email');
            $students->phone=$request->input('phone');
            $students->course=$request->input('course');

            if($request->hasFile('image')){
                $file=$request->file('image');
                $file_name=$file->getClientOriginalName();
                $path = public_path().'/student_files';
                $file->move($path,$file_name);
                $students->profile_image=$file_name;

            }
            $students->save();
            return response()->json([
                'status'=>200,
                'message'=>'student added successfully',
            ]);
        }


    }
    public function editStudent($id){
        $students=Student::find($id);
        if($students){
            return response()->json([
                'status'=>200,
                'students'=>$students,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>400,
                'message'=>'student not found',
            ]);
        }

    }

    public function updateStudent(Request $request,$id)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required|max:191',
            'email'=>'required|max:191',
            'phone'=>'required|max:12',
            'course'=>'required|max:191',
            'image'=>'required|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }
        else
            {
            $students=Student::find($id);
            if($students){
                $students->name=$request->input('name');
                $students->email=$request->input('email');
                $students->phone=$request->input('phone');
                $students->course=$request->input('course');

                if($request->hasFile('image')){
                    $path ='student_files/'.$students->profile_image;

                    if(File::exists($path))
                    {
                        File::delete($path);
                    }
                    $file=$request->file('image');
                    $file_name=$file->getClientOriginalName();
                    $path = public_path().'/student_files';
                    $file->move($path,$file_name);
                    $students->profile_image=$file_name;

                }
                $students->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'Student Updated Successfully',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>400,
                    'message'=>'student not found',
                ]);
            }

        }
    }

    public function destroy($id){
        $student= Student::find($id);
        if($student) {
            $path = 'student_files/' . $student->profile_image;

            if (File::exists($path)) {
                File::delete($path);
            }
            $student->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Student Data Delete successfully',
            ]);
        }

    }
}
