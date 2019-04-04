@extends('layouts.app')

@section('content')
    <h1>Create Posts</h1>
<form class="form-group" action="{{url('/posts')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="title">Title :</label>
       <input class="form-control" type="text" name="title" placeholder="title"><br>
     <label for="body">Body: </label>   
       <input class="form-control" type="text" name="body" placeholder="body"><br>
       <label for="location">Location link (from Google Maps): </label>   
       <input class="form-control" type="text" name="location" placeholder="location"><br>
       <label for="area">Select Area : </label> 
       <select class="form-control" name="area" id="">
            <option value="Vadodara">Vadodara</option>
            <option value="Ahmedabad">Ahmedabad</option>
            <option value="Surat">Surat</option>
            <option value="Rajkot">Rajkot</option>
            <option value="Dahod">Dahod</option>
        </select>
       <br>
       <input  type="radio" name="post_type" value="Formal">Formal complaint (to Municipal Corporation) <br><br>
       <input class="radio"  type="radio" name="post_type" value="Informal">Informal
       <br><br> <!--id="article-ckeditor"-->
        
       <div class="form-group">
            <input type="file" name="cover_image">
        </div>
        <input type="submit" class="btn btn-success btn-block" >
        <br>
       
    </form>
@endsection