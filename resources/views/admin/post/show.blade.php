<x-layout.admin>

    <x-slot:sidebarLeft>
        <div class="">
            <img src="https://place-hold.it/100x100/ddd/111/fff?text={{ $post->id }}"/>
        </div>
    </x-slot:sidebarLeft>


    <x-slot:sidebarRight>
        <div class="text-right" style="font-size: small;padding-top: 0.5rem">
            <div>Autor: {{ $post->author?->name ?? '' }}<br/>
                {{ $post->updated_at?->format('Y-m-d') ?? ''}}
            </div>
        </div>
    </x-slot:sidebarRight>


    <x-slot:page-class>post-{{$post->id}}</x-slot:page-class>

    <x-slot:breadcrumb>
        <a href="{{ route('admin.post.index') }}">Posty</a> ->
        <a href="{{ route('admin.post.show',['id'=>$post->id]) }}">{{ $post->title }}</a>
    </x-slot:breadcrumb>

    <x-slot:title>{{ $post->title }}</x-slot:title>

    <hr/>
    {!!   $post->content !!}
    <hr/>


    @if($post->thumbnail)
        <img style="width:100px;height: auto" src="{{ Storage::url($post->thumbnail) }}"/>
        <hr/>
    @endif

    <div class="button-row">
        <x-link-button :href="route('admin.post.edit',['id'=>$post->id])">Edytuj</x-link-button>
        <x-link-button href="#" onclick="document.getElementById('remove-form').submit()">Usuń</x-link-button>
    </div>
    <x-form id="remove-form" :action="route('admin.post.destroy')" method="DELETE">
        @bind($post)
        <x-form-input type="hidden" name="id"/>
        @endbind
    </x-form>


</x-layout.admin>

