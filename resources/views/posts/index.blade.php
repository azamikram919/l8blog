@extends('layouts.app')
@section('title', 'All Post')
@section('content')
    <div class="container">

        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                @if(session('message'))
                    <p class="alert alert-success">{{session('message')}}</p>
                @endif

                <br>

                <p class="alert alert-info">Page {{$posts->firstItem()}} of 5 Total records
                    {{$posts->total()}}
                </p>
            </div>
        </div>

        <div class="row">
            @if(count($posts)>0)
                @foreach($posts as $post)

                    <div class="col-sm-3 offset-sm-2 mt-3">
                        @if($post->thumbnail)
                            <img class="img-responsive img-thumbnail" width="200px"
                                 src="{{url('/public/images/'.$post->thumbnail)}}"
                                 alt="{{$post->title}}">
                        @endif
                    </div>
                    <div class="col-sm-6 pt-2">

                        <article>
                            <h2><a href="{{url('/posts/show/'.$post->id)}}">{{$post->title}}</a></h2>
                            <p>{{$post->body}}</p>
                            <a href="javascript:void(0)"><p> {{$post->updated_at->diffForHumans()}} </p></a>
                            <a href="{{url('/posts/create/')}}" class="btn btn-primary">Add New</a>
                            <a href="{{url('/posts/'.$post->id.'/edit/')}}" class="btn btn-info">Edit</a>
                            <a href="{{url('/posts/'.$post->id.'/delete/')}}" class="btn btn-danger">Delete</a>
                        </article>
                        <br><br>

                    </div>
                @endforeach
            @else
                <p>No Post Found</p>
            @endif
        </div>
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <div class="pagination">
                    {{$posts->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
