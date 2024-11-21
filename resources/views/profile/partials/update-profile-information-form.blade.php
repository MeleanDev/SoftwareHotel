<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Información del perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Actualice la información del perfil y la dirección de correo electrónico de su cuenta.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" required minlength="1" maxlength="255" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="apellido" :value="__('Apellido')" />
            <x-text-input id="apellido" required minlength="1" maxlength="255" name="apellido" type="text" class="mt-1 block w-full" :value="old('apellido', $user->apellido)"
                required autofocus autocomplete="apellido" />
            <x-input-error class="mt-2" :messages="$errors->get('apellido')" />
        </div>

        <div>
            <x-input-label for="telefono" :value="__('Telefono')" />
            <x-text-input id="telefono" required minlength="1" maxlength="20" name="telefono" type="text" class="mt-1 block w-full" :value="old('telefono', $user->telefono)"
                required autofocus autocomplete="telefono" />
            <x-input-error class="mt-2" :messages="$errors->get('telefono')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Correo')" />
            <x-text-input id="email" minlength="1" maxlength="255" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Su dirección de correo electrónico no está verificada.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Haga clic aquí para volver a enviar el correo electrónico de verificación.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Guardando.') }}</p>
            @endif
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
</section>
