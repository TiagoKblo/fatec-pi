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
</x-app-layout>
