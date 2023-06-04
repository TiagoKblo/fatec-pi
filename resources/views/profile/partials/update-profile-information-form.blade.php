<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informações do Perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Atualize as informações de perfil e o endereço de e-mail da sua conta.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Seu endereço de e-mail não foi verificado.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Clique aqui para reenviar o e-mail de verificação.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Um novo link de verificação foi enviado para o seu endereço de e-mail.') }}
                        </p>
                    @endif
                </div>
            @endif
            <div class="mt-2">
                <x-input-label for="unidade" :value="__('Unidade')" />
                <x-text-input id="unidade" name="unidade" type="text" class="mt-1 block w-full" :value="old('unidade', $matricula->unidade ?? 'Fatec Itapira - Ogari de Castro Pacheco')"
                    required autofocus autocomplete="unidade" />
                <x-input-error class="mt-2" :messages="$errors->get('unidade')" />
            </div>

            <div class="mt-2">
                <x-input-label for="grau" :value="__('Grau')" />
                <x-text-input id="grau" name="grau" type="text" class="mt-1 block w-full" :value="old('grau', $matricula->grau)"
                    required autofocus autocomplete="grau" />
                <x-input-error class="mt-2" :messages="$errors->get('grau')" />
            </div>
            <div class="mt-2">
                <label for="pes" class="block font-medium text-sm text-gray-700">{{ __('Pes') }}</label>
                <select id="pes" name="pes"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    required autofocus>
                    <option value="1">PES 1</option>
                    <option value="2">PES 2</option>
                    <option value="3">PES 3</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('pes')" />
            </div>

            <div class="mt-2">
                <x-input-label for="celular" :value="__('Celular')" />
                <x-text-input id="celular" name="celular" type="text" class="mt-1 block w-full" :value="old('celular', $matricula->celular)"
                    autocomplete="celular" />
                <x-input-error class="mt-2" :messages="$errors->get('celular')" />
            </div>

            <div class="mt-2">
                <x-input-label for="telefone" :value="__('Telefone')" />
                <x-text-input id="telefone" name="telefone" type="text" class="mt-1 block w-full" :value="old('telefone', $matricula->telefone)"
                    autocomplete="telefone" />
                <x-input-error class="mt-2" :messages="$errors->get('telefone')" />
            </div>

        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Salvar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Gravado com Sucesso.') }}</p>
            @endif
        </div>
    </form>
</section>
