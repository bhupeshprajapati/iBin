@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-primary btn-sm">Go Back</a>
    <div class="card">
    <div class="card-header">
        <h1>{{$post->title}}</h1>
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
    @if(!Auth::guest())
        @if(Auth::user()->id== $post->user_id)
            <a style="float:left" href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
                <form style="float:right" action="{{url('/posts/destroy')}}" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
                    <input type="hidden" name="id" value="{{$post->id}}">
                    <input type="submit" class="btn btn-danger" value="Delete">
                </form>
        @endif
        <form style="float:left;padding-left:10px;" action="{{url('/posts/like_status')}}" method="POST">
           @csrf
           <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
            <input type="hidden" name="id" value="{{$post->id}}">
            <input type="submit" class="btn btn-success" value="validate">
        </form>
        <form style="float:left;padding-left:10px;" action="{{url('/posts/like_status')}}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
            <input type="hidden" name="id" value="{{$post->id}}">
            <input type="submit" class="btn btn-danger" value="In-validate">
        </form>
        <button style="margin-left:10px;" type="submit" class="btn btn-primary" 
        data-toggle="collapse" data-target="#view-comments-{{$post->id}}" aria-expanded="false" aria-controls="view-comments-{{$post->id}}">View Comments</button>
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