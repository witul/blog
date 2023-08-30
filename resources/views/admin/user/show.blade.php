<x-layout.admin>
    <x-slot:breadcrumb>
        <a href="{{ route('admin.user.index') }}">Użytkownicy</a> ->
        <a href="{{ route('admin.user.create') }}">{{ $model->name }}</a>
    </x-slot:breadcrumb>

    <x-slot:title>{{$model->name}}({{  $model->email }})</x-slot:title>

    <div style="border-bottom: solid 1px black;font-size: 16px;">
        <div>Imię: <strong>{{ $model->name }}</div></strong>
        <div>Email: <strong>{{ $model->email }}</div></strong>
        <div>Rola: <strong>{{ $model->role->label() }}</div></strong>
        <div>Status: <strong>{{ $model->hasVerifiedEmail()?'Zweryfikowany':'Niezweryfikowany' }}</div></strong>
    </div>

    <div class="button-row">
    @if(!$model->hasVerifiedEmail())
        <x-link-button :href="route('admin.user.verify',['id'=>$model->id])">Weryfikuj</x-link-button>
    @endif
        <x-link-button :href="route('admin.user.edit',['id'=>$model->id])">Edytuj</x-link-button>
        <x-link-button :href="route('admin.user.reset',['id'=>$model->id])">Reset hasła</x-link-button>
        <x-link-button href="#" onclick="document.forms[0].submit()">Usuń</x-link-button>
    </div>

    <x-form :action="route('admin.user.destroy')" method="DELETE">
        @bind($model)
        <x-form-input type="hidden" name="id"/>
        @endbind
    </x-form>
</x-layout.admin>

