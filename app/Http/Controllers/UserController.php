<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\User;
use Illuminate\Support\Facades\File;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){

        return view('User.index');
    }

    public function fetchUser(){
        $users=User::with('phone')->get();

        return response()->json([
           'users'=>$users,
        ]);
    }

   public  function store(Request $request){
        //dd($request->all());

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
            $users=new User();
            $users->name=$request->input('name');
            $users->email=$request->input('email');
            if($request->hasFile('image'))
            {
               $file=$request->file('image');
               $file_name=$file->getClientOriginalName();
               $path=public_path().'/User_image';
               $file->move($path,$file_name);
               $users->image=$file_name;
            }
            $users->save();
            $phone= new Phone();
            //$phone->user_id=$users->id;
            $phone->phone=$request->input('phone');
            $users->phone()->save($phone);
            //$phone->save();
            return response()->json([
                'status'=>200,
                'message'=>'User added successfully',
            ]);


        }

   }

    public function editUser($id){
        $users=User::with('phone')->find($id);
        if($users){
            return response()->json([
                'status'=>200,
                'users'=>$users,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>400,
                'message'=>'User not found',
            ]);
        }

    }

    public function updateUser(Request $request,$id){
        $validator=Validator::make($request->all(),[
            'name'=>'required|max:191',
            'email'=>'required|email|max:191',
            'phone'=>'required|max:12',
            'image'=>'required|mimes:jpeg,jpg,png,gif|max:2048',

        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }
        else
        {
            $users=User::with('Phone')->find($id);
            if($users)
            {
                $users->name=$request->input('name');
                $users->email=$request->input('email');
                if($request->hasFile('image'))
                {
                    $path="User_image/".$users->image;
                    if(File::exists($path)){
                        File::delete($path);
                    }
                    $file=$request->file('image');
                    $file_name=$file->getClientOriginalName();
                    $path=public_path().'/User_image';
                    $file->move($path,$file_name);
                    $users->image=$file_name;

                }


            }
            else
            {
                return response()->json([
                    'status'=>400,
                    'message'=>'User not found',
                ]);
            }
            $users->update();
            $phone=new Phone();
            $phone->user_id=$users->id;
            $phone->phone=$request->input('phone');
            $phone->update($phone->phone);

            return response()->json([
                'status'=>200,
                'message'=>'User Update successfully',
            ]);

        }

    }


}
