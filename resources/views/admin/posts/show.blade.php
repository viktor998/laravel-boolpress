@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row ">
    
        <div class="col-md-12">
            
            <div class="card">

                    <div class="card-header">
                        <h2>{{ $post->title}}</h2>
                            @if($post->category)
                                <a href="{{route('category.index', ['slug'=> $post->category->slug])}}">
                                    <h5>{{$post->category->name}}</h5>
                                </a>
                            @endif
                    </div>

                <div class="row card-body align-items-center ">
                    <div class="col-md-10">
                        <p>{{ $post->content}}</p>

                        <img src="{{asset($post->cover)}}" alt="" class="img-fluid">
                    </div>
                    

                </div>

                <div class="row card-body">
                    <div class="col-md-1">
                            <a href="{{route('admin.posts.edit', ['post'=> $post->id])}}">Edit</a>
                        </div>
                    <div class="col-md-1">
                        <form  action="{{route('admin.posts.destroy', ['post'=> $post->id])}}" method='post'>
                            @csrf
                            @method('DELETE')
                        
                            <button type="submit" class="btn btn-primary">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection