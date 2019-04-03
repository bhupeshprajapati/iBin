@extends('layouts.app')

@section('content')
    <h1>Edit Posts</h1>
        <form class="form-group" action="{{url('/posts/update/')}}" method="POST">
        @csrf
            <label for="">Title :</label>
                <input class="form-control" type="text" name="title" value="{{$post->title}}" placeholder="title"><br><br>
            <label for="">Body: </label> 
                <input type="hidden" name="id" value="{{$post->id}}">
                <input  class="form-control " type="textarea" name="body" value="{{$post->body}}" placeholder="body"><br><br> <!--id="article-ckeditor"-->
                <input type="file" name="cover_image" value="{{$post->cover_image}}"><br><br>
                <input type="submit" class="btn btn-success btn-block" >
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
        </form>
@endsection