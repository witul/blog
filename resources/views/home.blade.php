<x-layout.front>
    <x-slot:title>Blog - strona główna</x-slot>
        <x-slot:page-class>home</x-slot>

            @foreach ($posts as $post)
                <div class="pb-2 post-item">
                    <img src="https://place-hold.it/100x100/ddd/111/fff?text={{ $post->id }}"/>

                    <div>
                        <h3 style="line-height:1.5;font-size: 1.4rem"><a
                                    href="{{ route('blog.post.show',['id'=>$post->id]) }}">{{$post->title}}</a></h3>
                        <div style="width: 60%;padding-top: 10px">
                            {{$post->excerpt}}
                        </div>
                    </div>

                    <div class="text-black-50 text-right meta">
                        <span class="date">{{$post->updated_at->format('Y-m-d')}}</span>
                    </div>
                    <hr/>
                </div>
            @endforeach
            @if(!is_array($posts))
                <div class="pt-4" style="max-height: 200px;!important;">{{ $posts->links() }}</div>
                <div class="pt-8"></div>

    @endif
</x-layout.front>
