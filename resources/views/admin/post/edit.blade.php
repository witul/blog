<x-layout.admin>
    <x-slot:breadcrumb>
        <a href="{{ route('admin.post.index') }}">Posty</a> ->
        <a href="{{ route('admin.post.show',['id'=>$model->id]) }}">{{ $model->title }}</a>
    </x-slot:breadcrumb>

    <div>

        @include('admin.post._form',[
            'route'=> route('admin.post.update',['id'=>$model->id]),
            'method'=>'PUT',
            'model'=>$model
        ])
    </div>

</x-layout.admin>

