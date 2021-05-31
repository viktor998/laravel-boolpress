@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row ">
    
        <div class="col-md-12">
            
            <div class="card">

                    <div class="card-header">
                        <h2>{{ $tag->name}}</h2>
                          
                    </div>

                <div class="row card-body align-items-center ">
                    
                    <div class="col-md-1">
                        <a href="{{route('admin.tags.edit', ['tag'=> $tag->id])}}">Edit</a>
                    </div>
                    <div class="col-md-1">
                        <form  action="{{route('admin.tags.destroy', ['tag'=> $tag->id])}}" method='post'>
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