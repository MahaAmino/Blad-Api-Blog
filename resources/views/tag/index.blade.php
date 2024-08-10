@extends('layout.app')
@section("title", "tag")
@section('content')
<div class="cont">
    <button class="btn btn-dark a"><a href="{{ route('tag.create') }}" >Add New tag</a></button>

    <table class="table table-success table-striped" >
        <thead>
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ( $tag as $t )
                <tr>
                    <td>
                        {{$t->name}}
                    </td>
                    <td>
                            <button type="button" class="btn btn-danger"><a href="{{route('tag.show' , $t->id )}}"> SHOW </a></button>
                            <button type="submit" class="btn btn-success"><a href="/tags/{{ $t->id }}"> EDIT </a></button>
                            <form action="{{ route('tag.destroy' , $t->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
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
