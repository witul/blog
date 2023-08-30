@if (Session::has('message'))
    <div {{ $attributes->merge(['class' => 'flash-message font-medium text-sm text-green-600 status-'.session('message.type')]) }}>
        {{ Session::get('message.message') }}
    </div>
@endif
