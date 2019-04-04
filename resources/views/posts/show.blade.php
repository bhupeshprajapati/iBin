@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-primary btn-sm">Go Back</a>
    <br><br>
    <div class="card">
    <div class="card-header">
        <h1 style="display:inline-block">{{$post->title}}</h1>
        <form  style="float:right;display:inline-block;" action="{{url('/posts/like_status')}}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
            <input type="hidden" name="id" value="{{$post->id}}">
            <input style="margin-left:5px;" type="submit" class="btn btn-danger btn-md" value="In-validate">
        </form>
        <form style="float:right;display:inline-block;"  action="{{url('/posts/like_status')}}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT">
             <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
             <input type="hidden" name="id" value="{{$post->id}}">
             <input   type="submit" class="btn btn-success btn-md" value="validate">
         </form>
    </div>
    <div class="card-body">
    <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}" alt="cover image">
    <br><br>
    <div>
        {!!$post->body!!} <!--!! to parse the html coming from the body due to ck editor-->
    </div>
    <hr>
    <small>Written on {{$post->created_at}}</small>
    <hr>
    </div>
    <div class="container">
       
    @if(!Auth::guest())
        @if(Auth::user()->id== $post->user_id)
            <a style="float:left" href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
                <form style="float:right" action="{{url('/posts/destroy')}}" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
                    <input type="hidden" name="id" value="{{$post->id}}">
                    <input type="submit" class="btn btn-danger btn-block" value="Delete">
                </form>
                <br><br>
        @endif
        
        <br>
        <button  type="submit" class="btn btn-warning btn-block" 
        data-toggle="collapse" data-target="#view-comments-{{$post->id}}" aria-expanded="false" aria-controls="view-comments-{{$post->id}}">View Comments</button>
        <br>
    </div>
        @endif
    <div class="card-footer">
        <form action="">
        <input type="hidden" name="post_comment" value="{{$post->id}}">
        <div class="form-group">
                <div class="input-group mb-3">
                    <input type="text" name="comment-text" id="comment-text" class="form-control" placeholder="Write a comment ..." aria-label="write a comment" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Comment</button>
                    </div>
                </div>
            </div>
        </form>
       
        <div class="collapse" id="view-comments-{{$post->id}}">
            
            @if($post->commetns)
                @foreach($post->comments as $comments)
                    {{$comment->comment_text}}
                @endforeach
            @else
                <p>This Post contains no comments.</p>
            @endif
        </div>    
        
    </div>
</div>

@endsection