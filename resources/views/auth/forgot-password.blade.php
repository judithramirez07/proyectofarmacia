  
<link rel="shortcut icon" href="icon.png"> 
    <title>Farmacias Cuquita</title>
<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
        <img width="100px" height="100px"src="icon.png" alt="Logo">
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Olvido su contraseña? No hay problema, solo ingrese su correo electrónico para restablecerla') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('Correo Electrónico') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Eviar link al correo') }}
                </x-jet-button>
            </div>
        </form>
        <button class="bg-indigo-500 text-white px-4 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black ">
              <a href="{{ url('') }}">Regresar</a>
              </button>
    </x-jet-authentication-card>
</x-guest-layout>
