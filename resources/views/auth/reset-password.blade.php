<x-layout.admin>
    <x-form action="{{ route('password.update') }}" method="POST">
        <div class="m-auto max-w-md p-4 " style="border: solid 1px blue">
            @csrf
            <div class="mb-6">
                <x-form-input type="hidden" name="token" value="{{ $token }}"></x-form-input>
                <x-form-input type="hidden" name="email" value="{{ $email }}"></x-form-input>
                <x-form-input type="password" name="password" show-password-icon="heroicon-m-eye"
                              hide-password-icon="heroicon-m-eye-slash" label="Hasło"
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                />

                <x-form-input type="password"
                              name="password_confirmation"
                              label="Ponownie"
                              show-password-icon="heroicon-m-eye"
                              hide-password-icon="heroicon-m-eye-slash"
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                />
            </div>
            <div class="flex items-center justify-between pt-2">
                <a class="inline-block align-baseline text-sm  hover:text-blue-800" href="{{ route('login') }}">Logowanie</a>
                <x-form-submit>
                        <span class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Zresetuj hasło
                        </span>
                </x-form-submit>
            </div>
        </div>
    </x-form>
</x-layout.admin>
