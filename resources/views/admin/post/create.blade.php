<x-layout.admin>
    <div>
        <h1>Nowy post</h1>
        {{-- <a href="{{ route('admin.post.index') }}" class="text-xl-right">Lista postów</a> --}}
    </div>
        @include('admin.post._form',[
            'route'=> route('admin.post.store'),
            'method'=>'POST',
        ])

</x-layout.admin>

