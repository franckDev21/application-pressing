<x-dashboard-layout>
    @empty($clients)
        <div class="p-4 rounded-md bg-red-100 text-red-400 text-4xl text-center font-extrabold">Aucun client</div>
    @else
    
        @if (Session::has('success'))
            <div class="p-3 rounded-md bg-green-100 text-green-400 text-2xl text-center font-extrabold">{{ session('success') }}</div>
        @endif

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nom
                    </th>
                    <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Email
                    </th>
                    <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Date
                    </th>
                    <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tél
                    </th>
                    <th scope="col" class="p-4 text-left  font-medium text-gray-500 uppercase tracking-wider">
                        <a href="{{ route('client.create') }}" class="bg-gray-600 rounded-md text-white px-4 py-2 text-xs">Ajouter un nouveau client</a>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($clients as $key => $client)
                    <tr class="{{ $key % 2 === 0 ? '' : 'bg-gray-50' }}">
                        <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                            {{ $client->nom }} <span class="font-semibold">{{ $client->prenom }} </span>
                        </td>
                        <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                            {{ $client->email }}
                        </td>
                        <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                            {{ $client->created_at->format('d M Y') }}
                        </td>
                        <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                            {{ $client->tel }}
                        </td>
                        <td class="p-4 flex items-center justify-center">
                            <a href="{{ route('client.edit',$client) }}" title="Edité {{ $client->nom.' '.$client->prenom }}" class="px-4 py-1 text-sm inline-block cursor-pointer rounded-md text-white bg-cyan-400 mr-1">éditer</a>
                            <a title="Supprimé {{ $client->nom.' '.$client->prenom }}" class="px-4  py-1 text-sm inline-block cursor-pointer rounded-md text-white bg-red-400">supprimer</a>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
        <div class="px-4 border-t pt-2">
            {{ $clients->links() }}
        </div>
    @endif
</x-dashboard-layout>
