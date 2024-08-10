<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function create()
    {
        $this->authorize('create',Comment::class);
        return redirect(view('posts.show',));
    }

    public function store(Request $request, $post_id )
    {
        $validator = FacadesValidator::make($request->all(),[
            'content'=>'required|string',
            'user_id'=>'require',
            ]);
            /* if($validator->fails()){
                return response($validator->messages(), 200);
            } */
            $comment=new Comment();
            $c=$comment->create(
            [  'content'=>$request['content'],
                'user_id' => Auth::id(),
                'post_id'=>$post_id,
            ]);

            return redirect()->route('post.show',$post_id);
    }

    public function edit(Comment $comment)
    {
        $this->authorize('update',$comment);
        $comments=Comment::find($comment->id);
        return view("comment.edit",['comment'=>$comments]);

    }

    public function update(Request $request, Comment $comment)
    {
        $validator = FacadesValidator::make($request->all(),[
            'content'=>'required|string',
            ]);
            if($validator->fails()){
                return response($validator->messages(), 200);
            }
            $ccc=$comment->update(
                [
                    'content'=>$request['content'],
                ]);
                return redirect()->route('post.show',$comment->post_id )->with("success","comment updated successfully");
    }


    public function destroy(Comment $comment)
    {
        $this->authorize('delete',$comment);
        $comment->delete();
        return redirect()->route('post.show',$comment->post_id)->with("success","comment deleted successfully");

    }
}

