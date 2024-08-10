@extends('layout.app')
@section("title", "users")
@section('content')
<div class="cont">
    <button class="btn btn-dark a"><a href="{{ route('admin.users.create') }}" >Add User</a></button>
<table class="table align-middle mb-0 bg-white">
    <thead class="bg-light">
      <tr>
        <th>User's Detiles</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
    @forelse ( $users as $user )
      <tr>
        <td>
          <div class="d-flex align-items-center">
            <img
                src="/assets/imgs/{{ $user->image }}"
                alt=""
                style="width: 45px; height: 45px"
                class="rounded-circle"
                />
            <div class="ms-3">
              <p class="fw-bold mb-1">{{$user->name}}</p>
              <p class="text-muted mb-0">{{$user->email}}</p>
            </div>
          </div>
        </td>
        <td>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <form action="{{ route('admin.users.destroy' , $user->id) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <input type="submit" value="DELETE"  class="btn btn-sm btn-rounded btn-success">
                        </form>
                    </div>
                    <div class="col-12 col-md-6">
                        <form action="{{ route('admin.users.ban' , $user->id) }}" method="POST">
                            @csrf
                            @method("PUT")
                            <input type="submit" @if ($user->status==false) value="✔" class="btn btn-sm btn-rounded btn-warning" @else value="❌"
                            @endif   class="btn btn-sm btn-rounded btn-danger">
                        </form>
                    </div>
                </div>
            </div>
        </td>
      </tr>
      @empty
      <p>🙂</p>
  @endforelse
    </tbody>
  </table>
</div>
@endsection
