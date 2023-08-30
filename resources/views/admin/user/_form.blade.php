<x-form :action="$route" :method="$method" enctype="multipart/form-data">
    @method($method)
    @isset($model)
        @bind($model)
    @endisset
    <x-form-input label="Imię" name="name"></x-form-input>
    <x-form-input type="email" label="Email" default="asd@asd.pl" name="email"></x-form-input>

    {{-- Pola na hasło są opcjonalne --}}


    <x-form-checkbox name="password_force" label="Ustaw hasło" id="force_password"  onchange="document.getElementById('password-group').hidden=!document.getElementById('password-group').hidden" />

    <div id="password-group" @if(!old('password_force',0)) hidden @endif>
    <x-form-input type="password" name="password" show-password-icon="heroicon-m-eye" :bind="false"
                  hide-password-icon="heroicon-m-eye-slash" label="Hasło"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
    />

    <x-form-input type="password" name="password_confirmation" show-password-icon="heroicon-m-eye" :bind="false"
                  hide-password-icon="heroicon-m-eye-slash" label="Hasło (ponownie)"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
    />
    </div>

    <x-form-select label="Rola" name="role" :default="($model ?? false) ? $model->role->value:'user'" :options="$roles"/>

    <div class="button-row">
        <x-form-submit type="submit">
            <span class="text-white-500">Zapisz</span>
        </x-form-submit>
    </div>


</x-form>

