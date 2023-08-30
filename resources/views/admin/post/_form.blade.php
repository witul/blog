<x-form :action="$route" :method="$method" enctype="multipart/form-data">
    @method($method)
    @isset($model)
        @bind($model)
    @endisset

    <x-form-input label="Tytuł" name="title"></x-form-input>

    <x-form-textarea label="Treść" name="content"></x-form-textarea>

    @if($model?->thumbnail ?? false)
        <div class="pt-10">
            <img style="width:100px;height: auto" src="{{ Storage::url($model->thumbnail) }}"/>
        </div>
    @endif
    <x-form-input label="Miniaturka" type="file" name="file"></x-form-input>

    <div class="button-row">
        <x-form-submit type="submit" class="m-1">
            <span class="text-white-500">Zapisz</span>
        </x-form-submit>
    </div>
    @endbind
</x-form>
