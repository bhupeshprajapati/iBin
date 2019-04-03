<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
use DB; //for direct SQL commands firing or without using eliquent
use Illuminate\Support\Facades\Storage;
class PostsController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=> ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       

        $posts =  Post::orderBy('created_at','asc')->get();
        //$posts =  Post::orderBy('created_at','desc')->take(1)->get();//limiting posts to show
        //return $post = Post::where('title','Post 2')->get();
        //using SQL COMMANDS DIRECTLY
       // return $posts=DB::select('SELECT * from posts');

       //PAGINATION

       $posts =  Post::orderBy('created_at','asc')->paginate(10);//paginae links are included in index.blade.php ...pagination will kick in after the 10th post
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request;
        $this->validate($request,[
         'title'=> 'required',
         'body'=> 'required',
         'cover_image' => 'image|nullable|max:1999'   
        ]);
        //Handle file upload
        if($request->hasFile('cover_image')){
            //Get filename with extention
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just file name
            $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filenaem to store
            $fileNameToStore = $filename.'.'.time().'.'.$extension;
            //Upload  Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }
        else{
            $fileNameToStore = 'noimage.jpg';
        }
        //Create Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body =$request ->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

       // return redirect('/posts')->with('success','Post Submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      /*  if(Input::has('post_comment')){
            $post= Input::get('post_comment');
            $commenttext= Input::get('comment-text');
            $selectedpost=Post::find($post);

            $selectedpost->comments()->create([
                'comment_text' => $commentBox,
                'user_id' =>Auth::user()->id,
                'post_id' => $post
            ]);
        }
        */
        //return redirect('/posts/{{$post->id}}')->with('success','Comment Posted');
        $post = Post::find($id);//returns the post of the given id
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);//returns the post of the given id
        
        //Check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error','Unauthorized Page !');     
        }
        
        return view('posts.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=> 'required',
            'body'=> 'required',  
           ]);

           
           // /Handle file upload
           if($request->hasFile('cover_image')){
            //Get filename with extention
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just file name
            $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filenaem to store
            $fileNameToStore = $filename.'.'.time().'.'.$extension;
            //Upload  Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }

           //Update Post
           $id = $request->input('id');
           $post = Post::find($id);
           $post->title = $request->input('title');
           $post->body =$request ->input('body');
           if($request->hasFile('cover_image')){
               $post->cover_image = $fileNameToStore;
           }
           $post->save();
           return redirect('/posts')->with('success','Post Updated');
           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id= $request->input('id');
        $post =Post::find($id);
        
        //Check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error','Unauthorized Page !');
        }
        if($post->cover_image!='noimage.jpg'){
            //Delete the image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        
            $post->delete();
            return redirect('/posts')->with('success','Post Removed');
    }

    

}
