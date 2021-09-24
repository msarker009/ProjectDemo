@extends('layouts.frontend')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(session('status'))
                    <div class="alter alter-success">{{session('status')}}</div>
                @endif
                <div class="card">
                    <div class="card-header">{{ __('Edit Posts') }}
                        <a href="{{url('posts')}}" class="btn btn-danger float-end">Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{url('posts/'.$post->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" value="{{$post->title}}" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" rows="5">{!! $post->description !!}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="status">Status</label>

                                <input type="checkbox" name="status" {!! $post->status==1 ?'checked':'' !!}> 0=show, 1=hide
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
