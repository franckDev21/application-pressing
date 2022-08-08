<x-dashboard-layout>
    @empty($approvisionnements)
        <div class="p-4 rounded-md bg-red-100 text-red-400 text-4xl text-center font-extrabold">Aucun approvisionnement</div>
    @else
        @if (Session::has('success'))
            <div class="p-3 rounded-md bg-green-100 text-green-400 text-2xl text-center font-extrabold">
                {{ session('success') }}</div>
        @endif

        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-extrabold text-gray-500">
                <span>#Liste des </span>
                <span class="text-cyan-500">approvisionnements</span>
            </h1>

            <div>
                <a
                  data-modal-toggle="add-user-modal"
                    class="px-4 rounded-md bg-gray-500 text-white py-1 border-4 uppercase font-bold hover:bg-gray-600 transition-all active:scale-[.90] border-gray-200 text-xs"><i
                        class="las la-plus"></i> Nouvel approvisionnement</a>
            </div>
        </div>

        {{-- Modal add approvisionnement --}}
        <x-modal-add-appro :produits="$produits" />
        {{-- Modal add approvisionnement --}}

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        quantite
                    </th>
                    <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Prix d'achat
                    </th>
                    <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        date
                    </th>
                    <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        type
                    </th>
                    <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        produit
                    </th>
                    <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Auteur
                    </th>
                    <th scope="col" class="p-4 text-left  font-medium text-gray-500 uppercase tracking-wider">

                    </th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($approvisionnements as $key => $approvisionnement)
                    <tr class="{{ $key % 2 === 0 ? '' : 'bg-gray-50' }}">
                        <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                            {{ $approvisionnement->quantite }} <span class="font-semibold">{{ $approvisionnement->prenom }}
                            </span>
                        </td>
                        <td
                            class="p-4 td-address font-semibold uppercase break-words whitespace-nowrap text-sm text-gray-900">
                            {{ number_format($approvisionnement->prix_achat, 0, ',', '  ') }} fcfa
                        </td>
                        <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                            {{ $approvisionnement->date->format('d M Y') }}
                        </td>
                        <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                            {{ $approvisionnement->type }}
                        </td>
                        <td class="p-4 uppercase whitespace-nowrap text-sm font-semibold text-gray-900">
                            {{ $approvisionnement->produit->nom }}
                        </td>
                        <td class="p-4 uppercase whitespace-nowrap text-sm font-semibold text-gray-900">
                            {{ $approvisionnement->user->name }}
                        </td>
                        <td
                            class="p-4 {{ auth()->user()->is_admin === true ? '' : 'disabled' }} flex items-center justify-center">
                            @if (auth()->user()->is_admin === true)
                                <form action="{{ route('appro.delete', $approvisionnement) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('voulez vous vraiment supprimer ?')"
                                        href="#" title="Supprimé"
                                        class="delete-btn px-4  py-1 text-sm inline-block cursor-pointer rounded-md text-white bg-red-400">supprimer</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="px-4 border-t pt-2">
            {{ $approvisionnements->links() }}
        </div>
        @endif

        {{-- Modal --}}

        <div id="modal"
            class="modal opacity-0 pointer-events-none fixed w-full flex justify-center items-center h-full bg-slate-400 top-0 left-0 right-0 bottom-0 z-50 bg-opacity-50">
            <div class="bg-white modal__card text-gray-600 rounded-md p-5 shadow max-w-sm w-full">
                <h1 class="text-2xl font-bold mb-3 text-gray-600">Confirmation</h1>
                <p class="mb-4">
                    confirmerz-vous la suppression de ce client ?
                </p>
                <div>
                    <button class="px-4 py-1 bg-gray-500 text-white rounded-md text-sm pb-1.5">annuler</button>
                    <button
                        class="px-4 py-1 bg-red-500 hover:bg-red-600 transition-all text-white rounded-md text-sm pb-1.5">supprimer</button>
                </div>
            </div>
        </div>

        @section('js')
            <script src="{{ asset('js/modal.js') }}"></script>
        @endsection
    </x-dashboard-layout>
