@extends('layout.app')
@section("title", "add category")
@section('content')
<div class="left" >
<table class="table table-success table-striped">
    <thead>
        <tr>
            <th>Title</th>
            <th>Image</th>
        </tr>
    </thead>
    <tbody>
        <form action="{{ route('cat.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <td>
            <label for="name">Title:</label>
            <input type="text" id="name" name="title">
        </td>
        <td>
            <label for="img">Image:</label>
            <input type="file" id="img" name="image">
        </td>
        </tbody>
</table>
        <div>
            <button type="submit"  class="btn btn-warning" style="color: rgb(59, 122, 122); font-weight: bolder " >Send </button>
        </div>
    </form>
</div>

@endsection
