@extends('layouts.app')

@section('content')

<div class="container">
<a href="{{route('admin.categories.create')}}">Create Category</a>
    <div class="row justify-content-center">
    
    @foreach( $categories as $category)
        <a href="{{route('admin.categories.show', ['category'=> $category->id])}}">
            <div class="col-md-3">
                
                <div class="card">
                    <div class="card-header">
                        <h2>{{ $category->name}}</h2>
                        
                    </div>


                    <div class="row card-body align-items-center">
                        <div class="col-md-3">
                            <a href="{{route('admin.categories.edit', ['category'=> $category->id])}}">Edit</a>
                        </div>
                        <div class="col-md-3">
                            <form action="{{route('admin.categories.destroy', ['category'=> $category->id])}}" method='post'>
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