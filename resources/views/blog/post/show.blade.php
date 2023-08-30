<x-layout.admin>

    <x-slot:sidebarLeft>
        <div class="">
            <img src="https://place-hold.it/100x100/ddd/111/fff?text={{ $post->id }}"/>
        </div>
    </x-slot:sidebarLeft>





    <x-slot:page-class>post-{{$post->id}}</x-slot:page-class>

    <x-slot:pageTitle>{{$post->title ?? 'Testowy blog'}}</x-slot:pageTitle>




    <div class="py-6">
        <div class="content" style="padding: 0 60px;">
            <div class="flex content-lead">
                @if($post->thumbnail)
                    <img style="width:100px;height: auto" src="{{ Storage::url($post->thumbnail) }}"/>
                @else
                    <img src="https://place-hold.it/100x100/ddd/111/fff?text={{ $post->id }}"/>
                @endif
                <h2>{{$post->title ?? 'Testowy blog'}}</h2>
            </div>
            <div class="text-right" style="font-size: small;padding-top: 0.5rem">Dodano: {{$post->updated_at->format('Y-m-d')}}</div>
            {{ $post->content }}
        </div>
    </div>
    </div>

</x-layout.admin>

