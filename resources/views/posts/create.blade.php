@extends('layouts.app')
@section('title', 'Create New Post')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <form action="{{url('posts')}}" enctype="multipart/form-data"
                      method="post" class="form-horizontal" role="form">
                    <div class="form-group">
                        <legend>Create New Post</legend>
                    </div>

                    @if(session('message'))
                        <p class="alert alert-success">{{session('message')}}</p>
                    @endif

                    {{--@if(count($errors)>0)--}}
                        {{--<ul>--}}
                            {{--@foreach($errors->all() as  $error)--}}
                                {{--<li class="alert alert-danger">{{$error}}</li>--}}
                            {{--@endforeach--}}
                        {{--</ul>--}}
                    {{--@endif--}}

                    {{csrf_field()}}
                    <div class="form-group">
                        @if($errors->has('title'))
                            <span class="help-block">
                                <strong class="alert alert-danger">
                                    {{$errors->first('title')}}
                                </strong>
                            </span>
                        @endif
                        <br><br><br>
                        <span for="inputTitle">Title</span>
                        <input type="text" name="title" id="inputTitle" class="form-control" value="{{old('title')}}">
                    </div>
                    <div class="form-group">
                        @if($errors->has('body'))
                            <span class="help-block">
                                <strong class="alert alert-danger">
                                    {{$errors->first('body')}}
                                </strong>
                            </span>
                        @endif
                        <span for="inputBody">Body</span>
                        <textarea name="body" id="inputBody" rows="3" class="form-control">{{old('body')}}</textarea>
                    </div>
                    <div class="form-group">
                        <span for="inputTitle">Upload Thumbnail</span>
                        <input type="file" name="thumbnail" id="thumbnail" class="form-control"
                               value="{{old('thumbnail')}}">
                    </div>

                    <div class="form-group">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection