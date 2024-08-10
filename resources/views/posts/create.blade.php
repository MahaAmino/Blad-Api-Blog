@extends('layout.app')
@section("title", "add post")
@section('content')

<div class="left" >
        <form action="/post" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="input-group ">
                <span class="input-group-text" id="inputGroup-sizing-lg">title</span>
                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" name="title" />
            </div>
            <div class="input-group">
                <span class="input-group-text">description</span>
                <textarea class="form-control" aria-label="With textarea" name="description" id="des"></textarea>
            </div>
            <div class="mb-3">
                <input class="form-control" type="file" id="img" name="image">
            </div>
            <select class="form-select" name="category">
                @foreach ($category as $c)
                    <option value={{ $c->id }}>{{ $c->title }}</option>
                @endforeach
            </select>
            <select class="form-select" aria-label="Default select example" multiple name="tag[]">
                @foreach ($tag as $t)
                    <option value={{ $t->id }}>{{ $t->name }}</option>
                @endforeach
            </select>
            <button type="submit"  class="btn btn-warning" style="color: rgb(59, 122, 122); font-weight: bolder " >Send </button>
        </div>
    </form>
</div>

@endsection


