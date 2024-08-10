@extends("layout.app")

@section("title","edit category")

@section("content")
<table class="table table-success table-striped" >
<thead>
    <tr>
        <th>Title</th>
        <th>Image</th>
    </tr>
</thead>
<tbody>
    <form action="/update/{{$category->id}}" method="POST" class="form-inline" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <td>
                <input type="text" id="tit" name="title" value="{{ $category->title }}">
            </td>
            <td>
                <img src="/assets/imgs/{{ $category->image }}"  class="img-fluid" alt="" width="100" height="150">
                <input type="file" id="img" name="image">
            </td>
</tbody>
</table>
<br>
    <div class="a">

        <button class="btn btn-warning"  style="color: rgb(59, 122, 122); font-weight: bolder " type="submit" >Send</button>
        <button class="btn btn-warning "><a href="{{ route('showAllCategories') }}">Home</a></button>
    </div>

</form>
@endsection

