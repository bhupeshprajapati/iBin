@extends('layouts.app')

@section('content')
    <h1>Edit Posts</h1>
        <form class="form-group" action="{{url('/posts/update/')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <label for="title">Title :</label>
                <input class="form-control" type="text" name="title" value="{{$post->title}}" placeholder="title"><br>
            <label for="body">Body: </label> 
                <input type="hidden" name="id" value="{{$post->id}}">
                <input  class="form-control " type="textarea" name="body" value="{{$post->body}}" placeholder="body"><br><br> <!--id="article-ckeditor"-->
                <label for="location">Location link (from Google Maps): </label>   
                <input class="form-control" type="text" name="location" value="{{$post->location}}" placeholder="location"><br>
                <label for="area">Select Area : </label> 
                <select class="form-control" name="area" id="">
                     <option value="{{$post->area}}">{{$post->area}}</option>
                     <option value="Vadodara">Vadodara</option>
                     <option value="Ahmedabad">Ahmedabad</option>
                     <option value="Surat">Surat</option>
                     <option value="Rajkot">Rajkot</option>
                     <option value="Dahod">Dahod</option>
                 </select>
                <br>
                <input  type="radio" name="post_type" value="Formal">Formal complaint (to Municipal Corporation) <br><br>
                <input class="radio"  type="radio" name="post_type" value="Informal">Informal
                <br><br>
                <input type="file" name="cover_image" value="{{$post->cover_image}}"><br><br>
                <input type="submit" class="btn btn-success btn-block" >
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
        </form>
@endsection