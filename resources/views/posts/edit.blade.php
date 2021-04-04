@extends('layouts.app')
@section('title', 'All Post')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <div class="mt-5">
                    <article>
                        <form action="{{url('/posts/update')}}" method="post" class="form-horizontal" role="form">
                            <div class="form-group">
                                <legend>Edit Post {{$post->title}}</legend>
                            </div>

                            @if(session('message'))
                                <p class="alert alert-success">{{session('message')}}</p>
                            @endif

                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{$post->id}}">
                            <div class="form-group">
                                <span for="inputTitle">Title</span>
                                <input type="text" name="title" id="inputTitle" class="form-control"
                                       value="{{$post->title}}">
                            </div>

                            <div class="form-group">
                                <span for="inputBody">Body</span>
                                <textarea name="body" id="inputBody" rows="3"
                                          class="form-control">{{$post->body}}</textarea>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection
