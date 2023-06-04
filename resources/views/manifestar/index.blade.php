<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manifestações de Interesse') }}
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
                        <li class="list-disc ml-5"><a href="profile" class="underline text-blue-500">Gerenciar Usuários</a></li>
                    </ul>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-lg font-semibold mb-4">Usuários que fizeram manifestações:</h2>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="py-3 px-6 text-left">ID do Edital</th>
                                <th class="py-3 px-6 text-left">ID do Manifesto</th>
                                <th class="py-3 px-6 text-left">ID do Docente</th>
                                <th class="py-3 px-6 text-left">Data de Manifestação</th>
                                <th class="py-3 px-6 text-left">Tabela de Pontuação</th>
                                <th class="py-3 px-6 text-left">Comprovante</th>
                                <th class="py-3 px-6 text-left">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($manifestos as $manifesto)
                            <tr class="hover:bg-gray-50">
                                <td class="py-4 px-6">{{ $manifesto->id }}</td>
                                <td class="py-4 px-6">{{ $manifesto->usuario }}</td>
                                <td class="py-4 px-6">{{ $manifesto->edital }}</td>
                                <td class="py-4 px-6">{{ $manifesto->partir_de }}</td>
                                <td class="py-4 px-6">
                                    <a href="{{ $manifesto->pontuacao }}" class="text-blue-500 underline">Pontuação</a>
                                </td>
                                <td class="py-4 px-6">
                                    <a href="{{ $manifesto->comprovante }}" class="text-blue-500 underline">Comprovante</a>
                                </td>
                                <td class="py-4 px-6">
                                    <form action="{{ route('manifestar.destroy', $manifesto->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Excluir" class="text-blue-500 underline cursor-pointer">
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
