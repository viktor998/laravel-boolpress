@extends('layouts.app')

@section('content')

<div class="container">
<a href="{{route('admin.posts.create')}}">Add Post</a>
<a href="{{route('admin.categories.index')}}">Categories</a>
<a href="{{route('admin.tags.index')}}">Tags</a>
    <div class="row justify-content-center">
    
    @foreach( $posts as $post)
        <a href="{{route('admin.posts.show', ['post'=> $post->id])}}">
            <div class="col-md-3">
                
                <div class="card">
                    <div class="card-header">
                        <h2>{{ $post->title}}</h2>
                        
                        @if($post->category)
                               
                            <h5>{{$post->category->name}}</h5>
                            
                        @endif
                    </div>

                    <div class="card-body">
                        {{ $post->content }}
                    </div>
                    <img src="{{asset($post->cover)}}" class="img-fluid" alt="Responsive image">
                        <div class="col-md-12">
                            @foreach($post->tags as $tag)
                                <a href="{{route('tag.index', ['slug'=> $tag->slug])}}">#{{$tag->name}}</a>
                            @endforeach
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