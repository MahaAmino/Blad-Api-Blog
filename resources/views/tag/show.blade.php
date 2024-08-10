@extends("layout.app")

@section("title","show tag")

@section("content")
<div class="card" style="width: 10rem;">
    <div class="card-body">
        <h5 class="card-title">{{ $tag->name }}</h5>
    </div>
    <button class="btn btn-warning a"><a href="{{ route('showAllTags') }}">Home</a></button>
</div>
@endsection

