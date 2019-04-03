@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @if(count($posts)>0)
        @foreach ($posts as $post)
        <div  class="list-group-item">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <img style="width:100%;height:300px;" src="/storage/cover_images/{{$post->cover_image}}" alt="cover image">
                </div>
                <div class="col-md-8 col-sm-4">
                    <div>
                        <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>    
                    </div>
                    <small>Written on {{$post->created_at}}</small>            
                </div>
            </div>
        </div>
        @endforeach
        {{$posts->links()}}   
        @else
            <p>No Posts found</p>
         @endif
         
@endsection