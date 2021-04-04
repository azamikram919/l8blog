@extends('layouts.app')
@section('title', 'All Post')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="mt-5">
                    <article>
                        @if(isset($post))
                            <h2>{{$post->title}}</h2>
                            <p>{{$post->body}}</p>
                        @endif
                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection
