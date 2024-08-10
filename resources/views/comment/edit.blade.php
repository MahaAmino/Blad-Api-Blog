@extends("layout.app")

@section("title","edit comment")

@section("content")

<table class="table table-success table-striped" >
<thead>
    <tr>
        <th>Content</th>
    </tr>
</thead>
<tbody>
    <form action="/CommentUpdate/{{ $comment->id }}" method="POST" class="form-inline" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <td>
                <input type="text" id="tit" name="content" value="{{ $comment->content }}">
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


