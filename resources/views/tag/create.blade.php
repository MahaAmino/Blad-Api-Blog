@extends('layout.app')
@section("title", "add tag")
@section('content')
<div class="left" >
<table class="table table-success table-striped">
    <thead>
        <tr>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
        <form action="/storeT" method="POST" enctype="multipart/form-data">
            @csrf
            <td>
                <input type="text" id="tit" name="name">
            </td>

    </tbody>
</table>
        <div>
            <button type="submit"  class="btn btn-warning" style="color: rgb(59, 122, 122); font-weight: bolder " >Send </button>
        </div>
    </form>
</div>

@endsection
