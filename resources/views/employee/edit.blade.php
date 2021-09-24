@extends('layouts.frontend')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Employee Data</h4>
                        <a href="{{url('employee')}}" class="btn btn-danger float-end">BACK</a>
                    </div>
                    <div class="card-body">
                        <form action="{{url('update-employee/'.$employee->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="name">Employee Name</label>
                                <input type="text" name="name" value="{{$employee->name}}" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Employee Email</label>
                                <input type="text" name="email" value="{{$employee->email}}" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="phone">Employee Phone</label>
                                <input type="tel" name="phone" value="{{$employee->phone}}" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="designation">Employee Designation</label>
                                <input type="text" name="designation" value="{{$employee->designation}}" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="status">Employee Status</label>
                                <input type="text" name="status" value="{{$employee->status}}" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
