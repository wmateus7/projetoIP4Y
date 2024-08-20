<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Digite o e-mail cadastrado para enviarmos os procedimentos.') }}
    </div>


    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>


        <div class="flex items-center justify-between mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('auth.login') }}">
                    {{ __('Voltar ao login') }}
                </a>

            <x-primary-button>
                {{ __('Enviar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
