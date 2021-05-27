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
<form action="{{route('admin.posts.update', ['post'=>$post->id])}}" method='post'>
    @csrf
    @method('PUT')

    <div class="form-group">
    <label for="exampleInputEmail1">Category</label>
    <select  class="form-control" id="category" name='category_id'>
      <option value="">Select</option>
      @foreach($categories as $category)
        <option value='{{$category->id}}' {{$category->id == old('category_id', $post->category_id)? 'selected': ''}}>{{$category->name}}</option>
      @endforeach
    </select>
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Title</label>
    <input type="text" class="form-control" value='{{$post->title}}' name='title' id="exampleInputEmail1" >
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Content</label>
    <textarea type="text" name='content' class="form-control" id="exampleInputPassword1">{{$post->content}}</textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

@endsection