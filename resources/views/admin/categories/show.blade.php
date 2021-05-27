@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row ">
    
        <div class="col-md-12">
            
            <div class="card">

                    <div class="card-header">
                        <h2>{{ $category->name}}</h2>
                          
                    </div>

                <div class="row card-body align-items-center ">
                    
                    <div class="col-md-1">
                        <a href="{{route('admin.categories.edit', ['category'=> $category->id])}}">Edit</a>
                    </div>
                    <div class="col-md-1">
                        <form  action="{{route('admin.categories.destroy', ['category'=> $category->id])}}" method='post'>
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