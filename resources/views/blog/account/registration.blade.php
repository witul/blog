<x-layout.front>

    <x-form action="{{ route('account.store') }}" method="POST">
        @csrf
        <div class="m-auto max-w-md p-4 " style="border: solid 1px blue">

            <div class="mb-4">
                <x-form-input label="Imię" name="name" input-id="name"
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"/>
            </div>


            <div class="mb-4">
                <x-form-input name="email" label="E-mail"
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                />
            </div>

            <div class="mb-6">

                <x-form-input type="password" name="password" show-password-icon="heroicon-m-eye"
                              hide-password-icon="heroicon-m-eye-slash" label="Hasło"
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                />

                <x-form-input type="password"
                              name="password_confirmation" label="Ponownie"
                              show-password-icon="heroicon-m-eye"
                              hide-password-icon="heroicon-m-eye-slash"
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                />
            </div>

            <hr/>

            <div class="flex items-center justify-between pt-2">
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
                   href="{{ route('password.request') }}"> Przypomnij hasło</a>

                <x-form-submit>
                    <span
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Utwórz konto</span>
                </x-form-submit>

            </div>

        </div>
    </x-form>

</x-layout.front>
