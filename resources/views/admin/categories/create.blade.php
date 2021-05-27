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
<form action="{{route('admin.categories.store')}}" method='post'>
    @csrf
    @method('POST')


  <div class="form-group">
    <label for="name">Category</label>
    <input type="text" class="form-control" name='name' id="name" >
    
  </div>


  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

@endsection