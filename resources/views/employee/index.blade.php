@extends('layouts.frontend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                @if(session('status'))
                    <div class="alert alert-success">{{session('status')}}</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Fetch Data From Database</h4>
                        <a href="{{url('add-employee')}}" class="btn btn-primary float-end">Add Employee</a>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Designation</th>
                                <th>status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($employee as $empd)
                                <tr>
                                    <td>{{$empd->id}}</td>
                                    <td>{{$empd->name}}</td>
                                    <td>{{$empd->email}}</td>
                                    <td>{{$empd->phone}}</td>
                                    <td>{{$empd->designation}}</td>
                                    <td>{{$empd->status}}</td>
                                    <td>
                                        <a href="{{url('edit-employee/'.$empd->id)}}" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{url('delete-employee/'.$empd->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection
