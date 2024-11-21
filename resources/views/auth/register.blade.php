<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" required minlength="1" maxlength="255" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="apellido" :value="__('Apellido')" />
            <x-text-input id="apellido" required minlength="1" maxlength="255" class="block mt-1 w-full" type="text" name="apellido" :value="old('apellido')" required autofocus autocomplete="apellido" />
            <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="identificacion" :value="__('Identificacion')" />
            <x-text-input id="identificacion" required minlength="1" maxlength="20" class="block mt-1 w-full" type="text" name="identificacion" :value="old('identificacion')" required autofocus autocomplete="identificacion" />
            <x-input-error :messages="$errors->get('identificacion')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="telefono" :value="__('Telefono')" />
            <x-text-input id="telefono" required minlength="1" maxlength="20" class="block mt-1 w-full" type="text" name="telefono" :value="old('telefono')" required autofocus autocomplete="telefono" />
            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" required minlength="1" maxlength="255" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const nameInput = document.getElementById('name');
            const apellidoInput = document.getElementById('apellido');
            const telefonoInput = document.getElementById('telefono');
            const emailInput = document.getElementById('email');

            nameInput.addEventListener('input', function() {
                this.value = this.value.replace(/\d/g, '');
            });

            apellidoInput.addEventListener('input', function() {
                this.value = this.value.replace(/\d/g, '');
            });

            telefonoInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });

            emailInput.addEventListener('input', function() {
                this.value = this.value.replace(/\s+/g, '');
            });
        });
    </script>
</x-guest-layout>
