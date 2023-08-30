<x-layout.admin>

    <x-slot:breadcrumb>
        <a href="{{ route('admin.user.index') }}">Użytkownicy</a>
        <a href="{{ route('admin.user.create') }}">Nowy użytkownik</a>
    </x-slot:breadcrumb>

    <x-slot:title>
        Lista użytkowników
    </x-slot:title>

    <x-slot:titleButtons>
        <a href="{{ route('admin.user.create') }}">Dodaj</a>
    </x-slot:titleButtons>

    @each('admin.user._index_item',$models,'model')

    <div class="pt-4" style="max-height: 200px;!important;">{{ $models->links() }}</div>
    <div class="pt-8"></div>

</x-layout.admin>

