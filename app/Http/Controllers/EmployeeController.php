<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index(){

        return view('User.index');
    }

    public function fetchEmployee(){
        $employees=Employee::with('phone')->get();

        return response()->json([
            'employees'=>$employees,
        ]);
    }

    public  function store(Request $request){


        $validator=Validator::make($request->all(),[
            'name'=>'required|max:191',
            'email'=>'required|email|max:191',
            'phone'=>'required|max:12',
            'image'=>'required|mimes:jpeg,jpg,png,gif|max:2048',

        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }
        else
        {
            $employees=new Employee();
            $employees->name=$request->input('name');
            $employees->email=$request->input('email');
            if($request->hasFile('image'))
            {
                $file=$request->file('image');
                $file_name=$file->getClientOriginalName();
                $path=public_path().'/User_image';
                $file->move($path,$file_name);
                $employees->image=$file_name;
            }
            $employees->save();
            $phone= new Phone();
            //$phone->user_id=$users->id;
            $phone->phone=$request->input('phone');
            $employees->phone()->save($phone);
            //$phone->save();
            return response()->json([
                'status'=>200,
                'message'=>'User added successfully',
            ]);


        }

    }

    public function editEmployee($id){
        $employees=User::with('phone')->find($id);
        if($employees){
            return response()->json([
                'status'=>200,
                'employees'=>$employees,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>400,
                'message'=>'Employee not found',
            ]);
        }

    }

    public function updateEmployee(Request $request,$id)
    {
        //return($request->all());
        $validator=Validator::make($request->all(),[
            'name'=>'required|max:191',
            'email'=>'required|email|max:191',
            'phone'=>'required|max:12',
//            'image'=>'required|mimes:jpeg,jpg,png,gif|max:2048',

        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }
        else
        {
            $employees=Employee::with('phone')->find($id);

            if($employees)
            {
                $employees->name=$request->input('name');
                $employees->email=$request->input('email');
                if($request->hasFile('image'))
                {
                    $path="User_image/".$employees->image;
                    if(File::exists($path)){
                        File::delete($path);
                    }
                    $file=$request->file('image');
                    $file_name=$file->getClientOriginalName();
                    $path=public_path().'/User_image';
                    $file->move($path,$file_name);
                    $employees->image=$file_name;

                }
                $employees->update();
                $phone=Phone::find($id);
                $phone->phone=$request->input('phone');
                $phone->update();
            }
            else
            {
                return response()->json([
                    'status'=>400,
                    'message'=>'Employee not found',
                ]);
            }

            return response()->json([
                'status'=>200,
                'message'=>'Employee Update successfully',
            ]);

        }

    }
}
