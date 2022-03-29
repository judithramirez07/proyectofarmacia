<link rel="shortcut icon" href="icon.png"> 
    <title>Farmacias Cuquita</title>
<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img width="100px" height="100px"src="icon.png" alt="Logo">
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Por favor confirme su contraseña antes de continuar') }}
        </div>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div>
                <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" autofocus />
            </div>

            <div class="flex justify-end mt-4">
                <x-jet-button class="ml-4">
                    {{ __('Confirm') }}
                </x-jet-button>
            </div>
        </form>
        <button class="bg-indigo-500 text-white px-4 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black ">
              <a href="{{ url('') }}">Regresar</a>
              </button>
    </x-jet-authentication-card>
</x-guest-layout>