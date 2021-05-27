@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
    
    @foreach( $posts as $post)
        <a class="col-md-3" href="{{route('posts.show', ['slug'=>$post->slug])}}">
            <div >
                
                <div class="card">
                    <div class="card-header">
                        <h2>{{ $post->title}}</h2>
                        <h5>{{$post->category->name}}</h5>
                    </div>

                    <div class="card-body">
                        {{ $post->content }}
                    </div>
                </div>
            </div>
        </a>
    @endforeach
    </div>
</div>
@endsection