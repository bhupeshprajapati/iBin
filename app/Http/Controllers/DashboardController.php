<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Storage;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $user_id=auth()->user()->id;
        $user=User::find($user_id);
   // return view('dashboard')->with('posts',$user->posts);
   return view('dashboard')->with('user',$user);
    }
    
    public function profilepic(Request $request){
        $this->validate($request,[
            'profile_pic' => 'image|nullable|max:1999'   
           ]);
        //return $request;
        if($request->hasFile('profile_pic')){
            //Get filename with extention
            $fileNameWithExt = $request->file('profile_pic')->getClientOriginalName();
            //Get just file name
            $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('profile_pic')->getClientOriginalExtension();
            //Filenaem to store
            $fileNameToStore = $filename.'.'.time().'.'.$extension;
            //Upload  Image
            $path = $request->file('profile_pic')->storeAs('public/profile_pic', $fileNameToStore);
        }
        else{
            $fileNameToStore = 'noimage.jpg';
        }
        $user_id=auth()->user()->id;
        $user=User::find($user_id);
        $user->profile_pic = $fileNameToStore;
        $user->save();
      
        return redirect('/dashboard')->with('success','Profile Pic Updated');
    }
}
