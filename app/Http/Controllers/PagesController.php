<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //metnod
    public function index(){
        $title= 'Welcome to Laravel!';
       // return view('pages.index',compact('title'));//it will look in the views forlder in pages folder a file named index.blade.php --passing a variable is also shown
        return view('pages.index')->with('title',$title);//another way fo passing multiple variable
    }
    public function about(){
        $title= 'ABOUT US';
        return view('pages.about')->with('title',$title);//another way fo passing multiple variable
        //done in a different way in about.blade.php file
    }
    
    public function services(){
        $data = array(
            'title'=>'Services',
            'services'=>['web design','seo','programming']
        );
        return view('pages.services')->with($data);
    }
}
