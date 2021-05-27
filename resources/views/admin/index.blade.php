@extends('layouts.app')

@section('content')

<div class="container">
<a href="{{route('admin.posts.create')}}">Add Post</a>
    <div class="row justify-content-center">
    
    @foreach( $posts as $post)
        <a href="{{route('admin.posts.show', ['post'=> $post->id])}}">
            <div class="col-md-3">
                
                <div class="card">
                    <div class="card-header">
                        <h2>{{ $post->title}}</h2>
                        <h5>{{$post->category->name}}</h5>
                    </div>

                    <div class="card-body">
                        {{ $post->content }}
                    </div>

                    <div class="row card-body align-items-center">
                        <div class="col-md-3">
                            <a href="{{route('admin.posts.edit', ['post'=> $post->id])}}">Edit</a>
                        </div>
                        <div class="col-md-3">
                            <form action="{{route('admin.posts.destroy', ['post'=> $post->id])}}" method='post'>
                                @csrf
                                @method('DELETE')
                            
                                <button type="submit" class="btn btn-primary">Delete</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </a>
    @endforeach
    </div>
</div>
@endsection