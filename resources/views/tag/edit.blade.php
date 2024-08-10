{{-- @extends("layout.app")

@section("title","edit tag")

@section("content")

<table class="table table-success table-striped" >
    <thead>
        <tr>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
        <form action="/updateT/{{$tag->id}}" method="POST" class="form-inline" >
            @csrf
            @method('PUT')
                <td>
                    <input type="text" id="name" name="name" value="{{ $tag->name }}">
                </td>
    </tbody>
</table>
<br>
    <div class="a">
        <button class="btn btn-warning"  style="color: rgb(59, 122, 122); font-weight: bolder " type="submit" >Send</button>
        <button class="btn btn-warning " type="submit"><a href='showAllTags'>Home</a></button>
    </div>

</form>
@endsection

 --}}
@extends("layout.app")

@section("title","edit tag")

@section("content")
<table class="table table-success table-striped" >
    <thead>
        <tr>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
        <form action="/updateTag/{{$tag->id}}" method="POST" class="form-inline" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <td>
                    <input type="text" id="tit" name="name" value="{{ $tag->name }}">
                </td>
    </tbody>
</table>
<br>
    <div class="a">

        <button class="btn btn-warning"  style="color: rgb(59, 122, 122); font-weight: bolder " type="submit" >Send</button>
        <button class="btn btn-warning "><a href="{{ route('showAllTags') }}">Home</a></button>
    </div>

</form>
@endsection


