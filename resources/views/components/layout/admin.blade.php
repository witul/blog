@php use Illuminate\Support\Facades\Auth; @endphp
<html>

<head>
    <title>{{ $title ?? 'Blog' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="{{ $pageClass ?? null }}">


<x-flash-message/>

<div class="top">
    <div><img src="https://place-hold.it/40x40/bbb/111/fff?text=logo"/></div>

    <div>
        <div class="flex flex-md-column menu">
            <a href="{{ route('blog.home') }}">Strona główna</a>

            @can('manage-posts')
                <a href="{{ route('admin.post.index') }}">Posty</a>
            @endcan

            @can('manage-users')
                <a href="{{ route('admin.user.index') }}">Użytkownicy</a>
            @endcan

            @if(Auth::check())
                <a class="pr-5" style="font-size: 0.8rem">
                    {{ Auth::user()->role->label() }}<br/><strong>{{ Auth::user()?->email ?? null }}</strong>
                </a>
            @endif

            <a href="{{ route('logout') }}">Wyloguj</a>
        </div>
    </div>
</div>

<div class="container m-auto grid grid-cols-12 gap-2">
    {{--
        <div class="col-span-2 col col-left justify-start sidebar left-top">
            {{ $areaLeftA ?? 'LEFT 1' }}
        </div>
    --}}
    <div class="col-start-3 col-span-8 col col-left sidebar center-bottom">

        @isset($breadcrumb)
            <div class="breadcrumb">{{ $breadcrumb ?? '' }}</div>
        @endisset

        @isset($title)
            <div class="title">
                <h2>{{ $title ?? '' }}</h2>
                <div>{{ $titleButtons ?? '' }}</div>
            </div>
        @endisset

        <div class="content">
            {{ $slot }}
        </div>
    </div>
    {{--
        <div class="col-start-11 col-span-2 flex justify-start col col-right sidebar right-top">
            {{ $areaRightA ?? 'RIGHT 1' }}
        </div>
    --}}
</div>

</body>
</html>

