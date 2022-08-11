<x-dashboard-layout>
  <div class="flex items-center justify-between border-b pb-4">
    <h1 class="text-2xl  font-extrabold text-gray-500">
        <span># caisse </span>
    </h1>
    <a href="{{ route('caisse.printCaisse') }}" target="_blank" class="px-4 rounded-md text-xs bg-gray-500 text-white py-1 border-4 uppercase font-bold hover:bg-gray-600 transition-all active:scale-[.90] border-gray-600">Imprimer l'état de la caisse<i class="las la-download text-sm text-white ml-1"></i></a>
  </div>

  <div class="grid grid-cols-2 gap-4 py-3 border-b border-t">
    <div class="bg-white shadow-md rounded-md px-4 py-4 text-center border-4 border-opacity-40 border-green-500 shadow-white">
      <h1 class="text-xl font-semibold text-gray-500 ">Montant total en caisse</h1>
      <span class="w-[40%] mx-auto block h-[1px] bg-green-400 my-2 opacity-20"></span>
      <span class="font-extrabold text-5xl text-green-500">{{ number_format($total, 0, ',', '  ') }} FCFA</span>
    </div>
  </div>

    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    date
                </th>
                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    montant
                </th>
                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    type
                </th>
                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                motif
                </th>
                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                auteur
                </th>
                <th scope="col" class="p-4 text-left  font-medium text-gray-500 uppercase tracking-wider">
                    <a data-modal-toggle="add-entrer-modal" class="px-4 rounded-md bg-cyan-500 text-white py-1 border-4 uppercase font-bold hover:bg-cyan-600 transition-all active:scale-[.90] border-cyan-200 text-xs"><i class="las la-plus"></i> entrer</a>
                    <a data-modal-toggle="add-sortie-modal" class="px-4 rounded-md bg-red-500 text-white py-1 border-4 uppercase font-bold hover:bg-red-600 transition-all active:scale-[.90] border-red-200 text-xs"><i class="las la-plus"></i> sortie</a>
                </th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @foreach ($caisses as $key => $caisse)
                <tr class="{{ $key % 2 === 0 ? '' : 'bg-gray-50' }}">
                    <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                        {{ $caisse->created_at->format('d M Y') }} 
                    </td>
                    <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                        {{ number_format($caisse->montant, 0, ',', '  ') }} FCFA
                    </td>
                    <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                        {{ $caisse->type }}
                    </td>
                    <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                    {{ $caisse->motif }}
                    </td>
                    <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                    {{ $caisse->user->name }}
                    </td>
                    <td class="p-4 flex items-center justify-center">
                    
                    </td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
<div class="px-4 border-t pt-2">
  {{ $caisses->links() }}
</div>

<!-- Modal -->
<div class="hidden overflow-x-hidden overflow-y-auto fixed top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center h-modal sm:h-full"
    id="add-entrer-modal">
    <div class="relative w-full max-w-2xl px-4 h-full md:h-auto">
        <div class="bg-white rounded-lg shadow relative">
            <div class="flex items-start justify-between p-5 border-b rounded-t">
                <h3 class="text-xl font-semibold">
                    Nouvel entée
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                    data-modal-toggle="add-entrer-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <div class="p-6 space-y-6">
                <form action="{{ route('caisse.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="grid grid-cols-2 gap-6">
                        <div class="col-span-2 sm:col-span-3">
                            <label for="montant" class="text-sm font-medium text-gray-900 block mb-2">Montant </label>
                            
                            <input type="number" min="1" name="montant" id="last-name"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                            placeholder="Montant" required>

                            <div class="text-red-400">@error('montant') {{ $message }} @enderror</div>
                        </div>
                        <div class="col-span-2 sm:col-span-3">
                            <label for="last-name" class="text-sm font-medium text-gray-900 block mb-2">Motif</label>
                            <textarea required placeholder="Motif ..." name="motif" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" id="" cols="30" rows="5"></textarea>
                            <div class="text-red-400">@error('quantite') {{ $message }} @enderror</div>
                        </div>
                    </div>
            </div>

            <div class="items-center p-6 border-t border-gray-200 rounded-b">
                <button
                    class="text-white w-full bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                    type="submit">Enregistrer la nouvelle entrée</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->


<!-- Modal -->
<div class="hidden overflow-x-hidden overflow-y-auto fixed top-4 left-0 right-0 md:inset-0 z-[100] justify-center items-center h-modal sm:h-full"
    id="add-sortie-modal">
    <div class="relative w-full max-w-2xl px-4 h-full md:h-auto">
        <div class="bg-white rounded-lg shadow relative">
            <div class="flex items-start justify-between p-5 border-b rounded-t">
                <h3 class="text-xl font-semibold">
                    Nouvel sortie
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                    data-modal-toggle="add-sortie-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <div class="p-6 space-y-6">
                <form action="{{ route('caisse.sortie') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="grid grid-cols-2 gap-6">
                        <div class="col-span-2 sm:col-span-3">
                            <label for="montant" class="text-sm font-medium text-gray-900 block mb-2">Montant </label>
                            
                            <input type="number" min="1" name="montant" id="last-name"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                            placeholder="Montant" required>

                            <div class="text-red-400">@error('produit_id') {{ $message }} @enderror</div>
                        </div>
                        <div class="col-span-2 sm:col-span-3">
                            <label for="last-name" class="text-sm font-medium text-gray-900 block mb-2">Motif</label>
                            <textarea required placeholder="Motif ..." name="motif" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" id="" cols="30" rows="5"></textarea>
                            <div class="text-red-400">@error('motif') {{ $message }} @enderror</div>
                        </div>
                    </div>
            </div>

            <div class="items-center p-6 border-t border-gray-200 rounded-b">
                <button
                    class="text-white w-full bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                    type="submit">Enregistrer la nouvelle sortie</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->


</x-dashboard-layout>