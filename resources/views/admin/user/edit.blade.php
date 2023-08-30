<x-layout.admin>
    <x-slot:breadcrumb>
        <a href="{{ route('admin.user.index') }}">Użytkownicy</a> ->
        <a href="{{ route('admin.user.edit',['id'=>$model->id]) }}">{{ $model->name }}</a>
    </x-slot:breadcrumb>

    <x-slot:title>Edycja konta {{ $model->email }}</x-slot:title>

    @include('admin.user._form',[
               'route'=> route('admin.user.update',['id'=>$model->id]),
               'method'=>'PUT',
               'roles'=>$roles,
               'model'=>$model
           ])
</x-layout.admin>

