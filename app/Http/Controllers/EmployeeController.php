<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(){
        $employee= Employee::all();
        return view('employee.index',compact('employee'));

    }
    public function create(){
        return view('employee.create');

    }
    public function store(Request $request){
        $employee=new Employee();
        $employee->name=$request->input('name');
        $employee->email=$request->input('email');
        $employee->phone=$request->input('phone');
        $employee->designation=$request->input('designation');
        $employee->status=$request->input('status');

        $employee->save();
        return redirect('employee')->with('status','Employee Added Successfully');
    }
    public function edit($id){
        $employee=Employee::find($id);
        return view('employee.edit',compact('employee'));
    }
    public function update(Request $request,$id){
        $employee=Employee::find($id);
        $employee->name=$request->input('name');
        $employee->email=$request->input('email');
        $employee->phone=$request->input('phone');
        $employee->designation=$request->input('designation');
        $employee->status=$request->input('status');

        $employee->update();
        return redirect('employee')->with('status','Employee Updated Successfully');

    }
    public function destroy($id){
        $employee=Employee::find($id);
        $employee->delete();
        return redirect('employee')->with('status','Employee Data Deleted Successfully');

    }

}

