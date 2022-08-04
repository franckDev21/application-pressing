<x-dashboard-layout>
    @empty($clients)
        <div class="p-4 rounded-md bg-red-100 text-red-400 text-4xl text-center font-extrabold">Aucun client</div>
    @else

        @if (Session::has('success'))
            <div class="p-3 rounded-md bg-green-100 text-green-400 text-2xl text-center font-extrabold">{{ session('success') }}</div>
        @endif
        
        <div class="flex items-center justify-between">
            <h1 class="text-2xl border-b pb-4 font-extrabold text-gray-500">
                <span>#Liste des </span>
                <span class="text-cyan-500">Clients</span>
            </h1>
            <a href="{{ route('client.printClient') }}" target="_blank" class="px-4 rounded-md text-xs bg-gray-500 text-white py-1 border-4 uppercase font-bold hover:bg-gray-600 transition-all active:scale-[.90] border-gray-600">Imprimer la liste des clients <i class="las la-download text-sm text-white ml-1"></i></a>
        </div>

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
                        <a href="{{ route('client.create') }}" class="px-4 rounded-md bg-cyan-500 text-white py-1 border-4 uppercase font-bold hover:bg-cyan-600 transition-all active:scale-[.90] border-cyan-200 text-xs"><i class="las la-plus"></i> Ajouter un nouveau client</a>
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
                            <a href="{{ route('client.edit',$client) }}" title="Edité {{ $client->nom.' '.$client->prenom }}" class="px-4 py-1 text-sm inline-block cursor-pointer rounded-md text-orange-500 bg-orange-100 mr-1">éditer</a>
                            <form action="{{ route('client.destroy',$client) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('voulez vous vraiment supprimer ?')" href="#" title="Supprimé {{ $client->nom.' '.$client->prenom }}" class="delete-btn px-4  py-1 text-sm inline-block cursor-pointer rounded-md text-white bg-red-400">supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
        <div class="px-4 border-t pt-2">
            {{ $clients->links() }}
        </div>
    @endif

    {{-- Modal --}}

    <div id="modal" class="modal opacity-0 pointer-events-none fixed w-full flex justify-center items-center h-full bg-slate-400 top-0 left-0 right-0 bottom-0 z-50 bg-opacity-50">
        <div class="bg-white modal__card text-gray-600 rounded-md p-5 shadow max-w-sm w-full">
            <h1 class="text-2xl font-bold mb-3 text-gray-600">Confirmation</h1>
            <p class="mb-4">
                confirmerz-vous la suppression de ce client ?
            </p>
            <div>
                <button class="px-4 py-1 bg-gray-500 text-white rounded-md text-sm pb-1.5">annuler</button>
                <button class="px-4 py-1 bg-red-500 hover:bg-red-600 transition-all text-white rounded-md text-sm pb-1.5">supprimer</button>
            </div>
        </div>
    </div>

    @section('js')
        <script src="{{ asset('js/modal.js') }}"></script>
    @endsection
</x-dashboard-layout>
