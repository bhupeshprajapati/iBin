@extends('layouts.app')

@section('content')
    <h1>Posts</h1> 
    @if(count($posts)>0)
        @foreach ($posts as $post)
        <div  class="list-group-item">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <img class="img-thumbnail" style="width:100%;" src="/storage/cover_images/{{$post->cover_image}}" alt="cover image">
                </div>
                <div class="col-md-8 col-sm-4">
                <a style="float:right" class="btn btn-warning btn-sm" href="{{$post->location}}" target="_">Take Action</a>
               
                    <div>
                        <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>    
                    </div>
                    <small >posted {{$post->created_at->diffForHumans()}}</small>
                    <br><br>
                    <label for="locat">Area :</label>
                        <h3 name="locat">{{$post->area}}</h3> 
                    <label for="locat">Post Type :</label>
                        <h3 name="locat">{{$post->post_type}}</h3>             
                    </div>
            </div>
        </div>
        @endforeach
        {{$posts->links()}}   
        @else
            <p>No Posts found</p>
         @endif
         
@endsection