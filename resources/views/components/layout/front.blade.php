<html>
<head>
    <title>{{ $title ?? 'Blog' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="{{ $pageClass ?? null }}">

<div class="top">
    <div>
        <img src="https://place-hold.it/40x40/bbb/111/fff?text=logo"/>
    </div>

    <div class="flex flex-md-column menu">

        @if(!Auth::id())
            <a href="{{ route('blog.home') }}">Start</a>
            <a href="{{ route('login') }}">Logowanie</a>
            <a href="{{ route('account.registration') }}">Rejestracja</a>
        @else
            @can('access-admin')
                <a href="{{ route('admin.post.index') }}">Panel</a>
            @endcan

            <span class="pr-5">{{ Auth::user()?->email ?? null }}</span>
            <a href="{{ route('logout') }}">Wyloguj</a>
        @endif

        @if(Auth::user())
            <a class="pr-5" style="font-size: 0.8rem">
                {{ Auth::user()->role->label() }}
                <br/>
                <strong>{{ Auth::user()?->email ?? null }}</strong>
            </a>
        @endif
    </div>
</div>


<div class="container m-auto grid grid-cols-12 gap-2">
    {{--
        <div class="col-span-2 col col-left justify-start sidebar left-top">
            {{ $areaLeftA ?? 'LEFT 1' }}
        </div>
    --}}
    <div class="col-start-3 col-span-8 col col-left sidebar center-bottom p-4">
        {{ $slot }}
    </div>
    {{--
    <div class="col-start-11 col-span-2 flex justify-start col col-right sidebar right-top">
        {{ $areaRightA ?? 'RIGHT 1' }}
    </div>
    --}}
</div>

</body>
</html>

