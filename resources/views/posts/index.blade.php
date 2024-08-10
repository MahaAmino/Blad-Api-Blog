@extends('layout.app')
@section("title", "posts")
@section('content')
    <div class="cont">
        <button class="btn btn-dark a"><a href="{{ route('post.create') }}" >Add New Post</a></button>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse ( $posts as $post )
                <div class="col">
                    <div class="card h-100 ">
                        <img src="/assets/imgs/{{ $post->image }}" class="card-img-top rounded-4 shadow-5" alt="" width="50" height="250">
                        <div class="card-body">
                            <h5 class="card-title">{{$post->title}}</h5>
                            <p class="card-text">{{$post->description}}</p>
                                @auth
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md">
                                            <button type="button" class="btn btn-outline-danger"><a href="{{route('post.show' , $post->id )}}"> SHOW </a></button>
                                        </div>
                                        <div class="col-md">
                                            @if (auth()->user()->can('update', $post))
                                                <button type="button" class="btn btn-outline-success"><a href="/edit/{{$post->id}}"> EDIT </a></button>
                                            @endif
                                        </div>
                                        <div class="col-md">
                                            @can('delete',$post)
                                                <form action="{{ route('post.destroy' , $post->id) }}" method="POST">
                                                    @csrf
                                                    @method("DELETE")
                                                    <input type="submit" value="DELETE" type="button" class="btn btn-outline-warning">
                                                </form>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                                @endauth
                        </div>
                    </div>
                </div>
            @empty
                <p></p>
            @endforelse
        </div>
    </div>
@endsection
