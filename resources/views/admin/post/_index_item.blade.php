<div class="pb-2 post-item">
    @if($post->thumbnail)
        <img style="width:100px;height: auto" src="{{ Storage::url($post->thumbnail) }}"/>
    @else
        <img src="https://place-hold.it/40x40/ddd/111/fff?text={{ $post->id }}"/>
    @endif

    <div>
        <h3 style="line-height:1.5;font-size: 1.4rem">
            <a href="{{ route('admin.post.show',['id'=>$post->id]) }}">
                {{$post->title}}
            </a></h3>
        <div style="width: 60%;padding-top: 10px">
            {{$post->excerpt}}
        </div>
    </div>

    <div class="flex-column"
         style="justify-content: space-between;align-items: end;display: flex;flex-direction: column">
        <div class="text-black-50 text-right meta-reverse">
            <span class="date">{{ $post->updated_at->format('Y-m-d') }}</span>
        </div>
    </div>

</div>
