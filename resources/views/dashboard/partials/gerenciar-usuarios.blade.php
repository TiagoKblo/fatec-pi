<div class="p-6 bg-white border-b border-gray-200">
    <div class="mt-6">
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full text-center text-sm font-light">
                            <thead class="font-medium bg-[#B00D15] text-white">
                                <tr>
                                    <th scope="col" class="px-6 py-4">#</th>
                                    <th scope="col" class="px-6 py-4">Nome</th>
                                    <th scope="col" class="px-6 py-4">E-mail</th>
                                    <th scope="col" class="px-6 py-4">Unidade</th>
                                    <th scope="col" class="px-6 py-4">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $user)
                                <tr class="even:bg-[#EBEFF1] odd:bg-white-100">
                                    <td class="border whitespace-nowrap px-6 py-4 font-medium">{{ $user->id }}</td>
                                    <td class="border whitespace-nowrap px-6 py-4">{{ $user->name }}</td>
                                    <td class="border whitespace-nowrap px-6 py-4">{{ $user->email }}</td>
                                    <td class="border whitespace-nowrap px-6 py-4">{{ $user->matricula->unidade }}</td>
                                    <td class="border whitespace-nowrap px-6 py-4">
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
                </div>
            </div>
        </div>
    </div>
</div>
