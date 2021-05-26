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
<form action="{{route('admin.posts.store')}}" method='post'>
    @csrf
    @method('POST')
  <div class="form-group">
    <label for="exampleInputEmail1">Title</label>
    <input type="text" class="form-control" name='title' id="exampleInputEmail1" >
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Content</label>
    <textarea type="text" name='content' class="form-control" id="exampleInputPassword1"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

@endsection