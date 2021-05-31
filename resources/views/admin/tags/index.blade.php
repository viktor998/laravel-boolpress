@extends('layouts.app')

@section('content')

<div class="container">
<a href="{{route('admin.tags.create')}}">Create Tag</a>
    <div class="row justify-content-center">
    
    @foreach( $tags as $tag)
        <a href="{{route('admin.tags.show', ['tag'=> $tag->id])}}">
            <div class="col-md-3">
                
                <div class="card">
                    <div class="card-header">
                        <h2>{{ $tag->name}}</h2>
                        
                    </div>


                    <div class="row card-body align-items-center">
                        <div class="col-md-3">
                            <a href="{{route('admin.tags.edit', ['tag'=> $tag->id])}}">Edit</a>
                        </div>
                        <div class="col-md-3">
                            <form action="{{route('admin.tags.destroy', ['tag'=> $tag->id])}}" method='post'>
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