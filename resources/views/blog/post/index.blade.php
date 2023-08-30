
@foreach($posts as $post)
    <h2>
        <a href="{{ route('front.post.show',['id'=>$post->id]) }}">
            {{ $post->title }}
        </a>
    </h2>
    <div>
        <p>{{ $post->excerpt }}</p>
    </div>
    <div>
        Ostatnia zmiana {{ $post->created_at }} przez {{ $post->author?->name }}
    </div>
    <hr/>

@endforeach
<div style="display:flex">{{ $posts->links() }}</div>
