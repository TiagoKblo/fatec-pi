<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="font-bold text-3xl">Ações Administrativas</h1>
                    <ul class="mt-2">
                        <li class="list-disc ml-5"><a href="{{ route('gerenciar') }}" class="underline text-blue-500">Gerenciar Editais</a></li>
                        <li class="list-disc ml-5"><a href="{{ route('manifestar.index') }}" class="underline text-blue-500">Gerenciar Manifestações<a></li>
                        <li class="list-disc ml-5"><a href="{{ route('profile.usuarios') }}" class="underline text-blue-500">Gerenciar Usuários</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Gerenciar Usuários') }}
            </h2>
        </header>

        <div class="mt-6">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">{{ __('Nome') }}</th>
                        <th class="px-4 py-2">{{ __('E-mail') }}</th>
                        <th class="px-4 py-2">{{ __('Unidade') }}</th>
                        <th class="px-4 py-2">{{ __('Ações') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $user)
                        <tr>
                            <td class="border px-4 py-2">{{ $user->name }}</td>
                            <td class="border px-4 py-2">{{ $user->email }}</td>
                            <td class="border px-4 py-2">{{ $user->unidade ?? 'Fatec Itapira - Ogari de Castro Pacheco' }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('profile.edit', $user->id) }}" class="text-blue-500 underline mr-2">{{ __('Editar') }}</a>
                                <form action="{{ route('profile.destroy', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 underline">{{ __('Excluir') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</x-app-layout>
