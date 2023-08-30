@props(['color' => 'blue'])
<a {{ $attributes->merge(['class'=> 'px-4 py-2 text-'.$color.'-100 no-underline bg-'.$color.'-500 rounded hover:bg-'.$color.'-600 hover:text-'.$color.'-200 ']) }}>
    {{ $slot }}
</a>
