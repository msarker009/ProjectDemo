@extends('layouts.frontend')

    @section('content')

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Employee</h4>
                            <a href="{{'employee'}}" class="btn btn-danger float-end">BACK</a>
                        </div>
                        <div class="card-body">
                            <form action="{{url('store-employee')}}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="name">Employee Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email">Employee Email</label>
                                    <input type="text" name="email" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="phone">Employee Phone</label>
                                    <input type="tel" name="phone" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="designation">Employee Designation</label>
                                    <input type="text" name="designation" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="status">Employee Status</label>
                                    <input type="text" name="status" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
