@extends('layouts.frontend')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(session('status'))
                    <div class="alter alter-success">{{session('status')}}</div>
                    @endif
                <div class="card">
                    <div class="card-header">{{ __('Add Posts') }}
                        <a href="{{url('posts')}}" class="btn btn-danger float-end">Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{url('posts')}}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" rows="5"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="status">Status</label>

                                <input type="checkbox" name="status"> 0=show, 1=hide
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
