@extends('layout.app')
@section("title", "category")
@section('content')
<div class="cont">
    <button class="btn btn-dark a"><a href="{{ route('cat.create') }}" >Add New category</a></button>

    <table class="table table-success table-striped" >
        <thead>
            <tr><th>Title</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ( $cat as $c )
                <tr>
                    <td>
                        {{$c->title}}
                    </td>
                    <td>
                        <img src="/assets/imgs/{{ $c->image }}" class="rounded-circle" alt="" width="90" height="100">
                    </td>
                    <td>
                            <button type="button" class="btn btn-danger"><a href="{{route('cat.show' , $c->id )}}"> SHOW </a></button>
                            <button type="submit" class="btn btn-success"><a href="/categories/{{ $c->id }}" > EDIT </a></button>
                            <form action="{{ route('cat.destroy' , $c->id) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <input type="submit" value="DELETE" type="button" class="btn btn-warning">
                            </form>
                    </td>
                </tr>

            @empty
                <p></p>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
