<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class PostController extends Controller
{
    public function index()
    { $this->authorize('viewAny',Post::class);
        $posts=Post::all();
        return response()->json($posts);
    }
    public function store(Request $request)
    {
        $validator = FacadesValidator::make($request->all(),[
        'title'=>'required|max:50',
        'description'=>'required|string',
        'image'=>'image|mimes:jpeg,jpg,png,gif|max:2048|required',
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
        return response()->json(["success"=>"post add successfully"],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $this->authorize('view',$post);
        $user=Auth::user();
        $tags=$post->tags()->get();
        $comment = Comment::where('post_id', $post->id)->get();
        return response()->json(['post'=>$post,'comment'=>$comment,'tags'=>$tags]/* ,$tags,$comment,$user */);
    }
    public function update(Request $request, Post $post)
    { $this->authorize('update',$post);
            $validator = FacadesValidator::make($request->all(),[
            'title'=>'required|max:50',
            'description'=>'required|string',
            'image'=>'image|mimes:jpeg,jpg,png,gif|max:2048|nullable',
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
                return response()->json(["success"=>"post updated successfully"],200);

    }
    public function destroy(Post $post)
    {
        $this->authorize('delete',$post);
        $post->delete();
        return response()->json(["success"=>"post deleted successfully"],200);
    }
}
