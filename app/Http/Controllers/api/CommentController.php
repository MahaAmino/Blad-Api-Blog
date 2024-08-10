<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\api\PostController;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class CommentController extends Controller
{
    public function index(Comment $comment)
    {
        $comment = Comment::where('id',$comment->id)->get();
        return response()->json($comment);
    }
    public function show(Post $post)
    {
        $comment = Comment::where(['post_id'=> $post->id])->get();
        return response()->json($comment);
    }
    public function store(Request $request, $post_id )
    {
        FacadesValidator::make($request->all(),[
            'content'=>'required|string',
            'user_id'=>'require',
            ]);
            $comment=new Comment();
            $comment->create(
            [  'content'=>$request['content'],
                'user_id' => Auth::id(),
                'post_id'=>$post_id,
            ]);
        return response()->json(['message'=>'comment added successfully'],200);
    }
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update',$comment);
        $validator = FacadesValidator::make($request->all(),[
            'content'=>'required|string',
            ]);
            if($validator->fails()){
                return response($validator->messages(), 200);
            }
            $comment->update(['content'=>$request['content'],]);
            return response()->json(['message'=>'comment updated successfully'],200);
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete',$comment);
        $comment->delete();
        return response()->json(['message'=>'comment deleted successfully'],200);

}
}
