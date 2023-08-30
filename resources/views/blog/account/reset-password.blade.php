<x-layout.front>
    <x-form action="{{ route('password.email') }}" method="POST">
        <div class="m-auto max-w-md p-4 " style="border: solid 1px blue">
            @csrf
            <div class="mb-4">
                <x-form-input name="email" label="E-mail" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
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
</x-layout.front>
