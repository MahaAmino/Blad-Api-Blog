@extends('layout.app')
@section("title", "add user")
@section('content')

<div class="left" >
<table class="table table-success table-striped">
    <thead>
        <tr>
            <th>name</th>
            <th>email</th>
            <th>password</th>
            <th>Confirm Password</th>
            <th>Image</th>
        </tr>
    </thead>
    <tbody>
        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <td>
            <input type="text" id="name" name="name">
        </td>
        <td>
            <input type="email" id="form3Example2"  name="email" />
        </td>

        <td>
            <input type="password" id="form3Example3"  name="password"/>
        </td>

        <td>
            <input type="password" id="form3Example4"  name="password_confirmation" />
        </td>
        <td>
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


