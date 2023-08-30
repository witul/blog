<x-layout.admin>
    <x-slot:breadcrumb>
        <a href="{{ route('admin.user.index') }}">Użytkownicy</a> ->
        <a href="{{ route('admin.user.create') }}">Nowy użytkownik</a>
    </x-slot:breadcrumb>

    <x-slot:title>Tworzenie konta użytkownika</x-slot:title>
    @include('admin.user._form',[
               'route'=> route('admin.user.store'),
               'method'=>'POST',
               'roles'=>$roles,
           ])


</x-layout.admin>

