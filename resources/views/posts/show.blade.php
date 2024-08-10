@extends("layout.app")

@section("title","show post")

@section("content")
@php
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
@endphp
<div class="card text-center" style="width: 57rem; ">
    <div class="d-flex p-2">
        <img src="/assets/imgs/{{ $post->user->image }}"alt=""style="width: 45px; height: 45px"class="rounded-circle"/>
        <p class="small mb-0 ms-2">{{$post->user->name}}</p>
    </div>
    <img src="/assets/imgs/{{ $post->image }}"  class="card-img-top"  width="30" height="500" alt="Fissure in Sandstone"/>
    <div class="card-body text-center">
        <h5 class="card-title">{{ $post->title }}</h5>
        <p class="card-text">{{ $post->description }}</p>
        <div>
            <ul class="list-group list-group-horizontal list-inline mx-auto justify-content-center">
                <li class="list-group-item">{{ $post->category->title }} </li>
            </ul>
            <ul class="list-group list-group-horizontal list-inline mx-auto justify-content-center">
                @foreach ( $tags as $item)
                    <li class="list-group-item">{{ $item->name }} </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-0 border" style="background-color: #f0f2f5;">
                <div class="card-body p-4">
                    <div data-mdb-input-init class="form-outline mb-4">
                        <form action="/CommentStore/{{ $post->id }}" method="POST">
                            @csrf
                            <input type="text" id="addANote" name ="content" class="form-control" placeholder="Your comment..." />
                            <label class="form-label" for="addANote">+ Add a note</label>
                            <br>
                            <button class="btn btn-warning a" type="submit">send</button>
                        </form>
                    </div>
                    @foreach ($comment as $comments)
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>{{  $comments->content }} </p>
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center">
                                        @php
                                            $comment = Comment::find($comments->id);
                                        @endphp
                                        <img src="/assets/imgs/{{ $comment->user->image }}" alt="avatar" width="25" height="25" class="rounded-circle" />
                                        <p class="small mb-0 ms-2">{{ $comment->user->name }}</p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center text-body">
                                    @can('update',$comments)
                                        <button class="small mb-0 btn btn-danger" type="submit"><a href="/comm_edit/{{ $comment->id }}"> ✏</a></button>
                                    @endcan
                                    @can('delete',$comments)
                                        <form action="{{ route('commentDestroy' , $comment->id) }}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <input type="submit" value="🗑" type="button" class="btn btn-info">
                                        </form>
                                    @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
@endsection

