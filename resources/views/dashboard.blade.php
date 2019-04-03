@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard
                        <a style="float:right" href="/posts/create" class="btn btn-success btn-sm">Create Post</a>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                        <img class="image-responsive border-circle" style="width:100px;height:100px" src="/storage/profile_pic/{{$user->profile_pic}}" alt="{{$user->name}}">
                        <br><br>
                        <form class="form-group" action="{{url('/dashboard/profilepic')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="form-group">
                                    <input  type="file" name="profile_pic">
                                </div>
                                <input type="submit" value="Change pic" class="btn btn-primary btn-sm">
                            </form>
                        </div>
                    <div class="col-md-8 well">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <table width="50%" class="tabel table-bordered table-dark ">
                                <tr>
                                    <th scope="row">Points :</th>
                                    <td scope="row">123</td>
                                </tr>
                                <tr>
                                    <th scope="row">League :</th>
                                    <td scope="row">GOLD</td>
                                </tr>
                            </table>
                        <br><br>  
                        You are logged in!
                    </div>
                </div>
                </div>
            </div>
        <br>
        <div class="card">
                <div class="card-header">Details
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                       
                    <div class="col-md-12">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th scope="row">ID :</th>
                                <td >{{$user->id}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Name :</th>
                                <td>{{$user->name}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Email :</th>
                                <td>{{$user->email}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card">
            <div class="card-header">
                Advertisements
            </div>
            <div style="width:100%;height:300px" class="card-body">

            </div>
        </div>
    </div>
</div>
@endsection
