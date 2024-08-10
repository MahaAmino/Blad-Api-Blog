<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class PostController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny',Post::class);
        $posts= Post::all();
        return view("posts.index",compact('posts'));
    }
    public function create()
    {
        $this->authorize('create',Post::class);
        $tag= Tag::all();
        $category= Category::all();
        return view("posts.create",['tag' => $tag,'category'=>$category]);
    }
    public function store(Request $request)
    {
        $validator = FacadesValidator::make($request->all(),[
        'title'=>'required|max:50',
        'description'=>'required|string',
        'image'=>'image|mimes:jpeg,jpg,png,gif|required',
        'category'=>'required',
        'tag'=>'required|array',
        'user_id'=>'require',
        ]);
        if($validator->fails()){
            return response($validator->messages(), 200);
        }
        $post=new Post;
        if($request->hasFile('image')){
                $img=$request['image'];
                $imgName=time().".".$img->getClientOriginalExtension();
                $img->move('./assets/imgs',$imgName);
                $data['image']=$imgName;
        }
        $post1=$post->create(
        [  'title'=>$request['title'],
            'description'=>$request['description'],
            'image'=>$imgName,
            'category_id'=>$request->category,
            'user_id' => Auth::id(),
        ]);
        $post1->tags()->attach($request->tag);
        return redirect()->route('post.index')->with("success","post add successfully");
    }
    public function show(Post $post)
    {
        $this->authorize('view',$post);
        $user=Auth::user();
        $tags=$post->tags()->get();
        $comment = Comment::where('post_id', $post->id)->get();
        return view("posts.show",compact('post','user' , 'tags','comment'));
    }
    public function edit(Post $post)
    {   $this->authorize('update',$post);
        $tag= Tag::all();
        $tags=$post->tags()->get();
        $category= Category::all();
        $user=Auth::user();
        return view("posts.edit",['tag'=>$tag,'category'=>$category,'user'=>$user,'post'=>$post,'tags'=>$tags]);
    }
    public function update(Request $request, Post $post)
    {
            $validator = FacadesValidator::make($request->all(),[
            'title'=>'required|max:50',
            'description'=>'required|string',
            'image'=>'image|mimes:jpeg,jpg,png,gif|nullable',
            'category'=>'required',
            'tag'=>'required|array',
            ]);
            if($validator->fails()){
                return response($validator->messages(), 200);
            }
            $imgName=$post->image;
            if($request->hasFile('image')){
                $img=$request['image'];
                $imgName=time().".".$img->getClientOriginalExtension();
                $img->move('./assets/imgs',$imgName);
                $data['image']=$imgName;
                }
                $post->update(
                [  'title'=>$request['title'],
                    'description'=>$request['description'],
                    'image'=>$imgName,
                    'user_id' => Auth::id(),
                    'category_id'=>$request->category,
                ]);
                $post->tags()->detach($post->tags()->get());
                $post->tags()->attach($request->tag) ;
                return redirect()->route('post.index')->with("success","post updated successfully");
    }
    public function destroy(Post $post)
    {   $this->authorize('delete',$post);
        $post->delete();
        return redirect()->route('post.index')->with("success","post deleted successfully");
    }
}
