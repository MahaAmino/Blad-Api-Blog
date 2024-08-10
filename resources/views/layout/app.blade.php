<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title")</title>
<link rel="stylesheet" href="/assets/css/style.css">
<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
</head>
<body >
    <nav class="navbar bg-light " >
        {{-- <img src="/assets/imgs/hap.png" alt="" width="200px" height="72px"> --}}
        <ul>
            <li><button type="button" class="btn btn-outline-info"><a href="/" >POSTS</a></button></li>
            {{-- @can('manager',App\Models\User::class) --}}
                <li><button type="button" class="btn btn-outline-warning"><a href="{{ route('admin.users.index') }}">USERS</a></button></li>
                <li><button type="button" class="btn btn-outline-success"><a href="{{ route('showAllCategories') }}">Categories</a></button></li>
                <li><button type="button" class="btn btn-outline-danger"><a href="{{ route('showAllTags') }}">Tags</a></button></li>
           {{--  @endcan --}}

        </ul>
        <button class="btn btn-success"><a href="{{ route('logout') }}">Log Out</a></button>
    </nav>

    <div class="container-fluid">
        @yield('content')
    </div>
    {{-- <footer class="bg-light">💛 May your heart be filled with happiness today and always 💛</footer> --}}
    <script href="/assets/js/bootstrap.min.js"></script>
</body>
</html>

