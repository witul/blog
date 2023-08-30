<x-layout.admin>
    <x-slot:areaLeftA>LEFT 1</x-slot:areaLeftA>
    <x-slot:areaLeftA>areaLeftA</x-slot:areaLeftA>
    <x-slot:areaRightA>areaRightA</x-slot:areaRightA>

    <x-slot:breadcrumb>
        <a href="{{ route('admin.post.index') }}" class="text-xl-right">Lista postów</a> ->
        <a href="{{ route('admin.post.create') }}" class="a text-xl-right">Nowy post</a>
    </x-slot:breadcrumb>

    <x-slot:title>
        Lista postów
    </x-slot:title>

    <x-slot:titleButtons>
        <a href="{{ route('admin.post.create') }}">Dodaj</a>
    </x-slot:titleButtons>

    <div style="">
    @each('admin.post._index_item', $posts, 'post')
    </div>
    <div class="pt-4" style="max-height: 200px;!important;">{{ $posts->links() }}</div>
    <div class="pt-8"></div>

</x-layout.admin>

