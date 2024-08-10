@extends("layout.app")

@section("title","edit post")

@section("content")
<table class="table table-success table-striped" >
<thead>
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Tags</th>
        <th>Category</th>
        <th>Image</th>
    </tr>
</thead>
<tbody>
    <form action="/post/{{ $post->id }}" method="POST" class="form-inline" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <td>
                <input type="text" id="tit" name="title" value="{{ $post->title }}">
            </td>
            <td>
                <textarea name="description" id="des" cols="30" rows="3">{{ $post->description }}</textarea>
            </td>
            <td>
                <select data-mdb-select-init multiple name="tag[]">
                    @foreach ($tag as $tagg )
                        <option value={{ $tagg->id }} @foreach ($tags as $ta )
                            @if ($ta->id == $tagg->id )
                                @selected(true)
                            @endif
                        @endforeach>{{ $tagg->name }}</option>
                    @endforeach
            </td>
            <td>
                <select name="category" >
                    @foreach ($category as $c)
                    <option value={{ $c->id }} @if($post->category_id ==$c->id) @selected(true) @endif>{{ $c->title }} </option>
                    @endforeach
                </select>
            </td>
            <td>
                <img src="/assets/imgs/{{ $post->image }}" alt="" class="img-fluid" alt="" width="100" height="150">
                <input type="file" id="img" name="image">
            </td>


</tbody>
</table>
<br>
    <div class="a">

        <button class="btn btn-warning"  style="color: rgb(59, 122, 122); font-weight: bolder " type="submit" >Send</button>
        <button class="btn btn-warning "><a href="/">Home</a></button>
    </div>

</form>
@endsection

