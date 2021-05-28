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
                        @if($post->category)
                               
                            <h5>{{$post->category->name}}</h5>
                            
                        @endif
                    </div>
                    <img src="{{asset($post->cover)}}" class="img-thumbnail" alt="Responsive image">
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