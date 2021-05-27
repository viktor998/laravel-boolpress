@extends('layouts.app')


@section('content')



<div class="container">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('admin.categories.update', ['category'=>$category->id])}}" method='post'>
    @csrf
    @method('PUT')

   
  <div class="form-group">
    <label for="exampleInputEmail1">Title</label>
    <input type="text" class="form-control" value='{{$category->name}}' name='name' id="exampleInputEmail1" >
    
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

@endsection