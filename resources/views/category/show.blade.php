@extends("layout.app")

@section("title","show category")

@section("content")
<div class="card" style="width: 10rem;">
    <div class="card-body">
        <h5 class="card-title">{{ $category->title }}</h5>
    </div>
    <img class="card-img-top" src="/assets/imgs/{{ $category->image }}" alt="Card image cap" width="10" height="100">
</div>
@endsection

