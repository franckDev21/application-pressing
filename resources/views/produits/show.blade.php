<x-dashboard-layout>
  <div class="flex items-center justify-between pb-4">
    <h1 class="text-2xl  font-extrabold text-gray-500">
        <span># page produit :  </span>
        <a href="{{ route('produit.edit',$produit) }}" class="text-cyan-500 underline">{{ $produit->nom }}</a>
    </h1>
    <div class="flex">
      <a href="{{ route('appro.index')  }}" class="px-4 rounded-md text-xs bg-green-500 text-white py-1 border-4 uppercase font-bold hover:bg-green-600 transition-all active:scale-[.90] border-green-600 mr-4">Historique produits <i class="las la-clock text-sm text-white ml-1"></i></a>
      <a href="{{ route('produit.printProduit') }}" target="_blank"  class="px-4 text-xs rounded-md  bg-gray-500 text-white py-1 border-4 uppercase font-bold hover:bg-gray-600 transition-all active:scale-[.90] border-gray-600">Imprimer la liste des produits <i class="las la-download text-sm text-white ml-1"></i></a>
    </div>
  </div>
  <div class="grid grid-cols-3 gap-4 py-3 border-b border-t">
    <div class="bg-white shadow-md rounded-md px-3 py-4 text-center border-4 border-opacity-40 border-green-500 shadow-white">
      <h1 class="text-xl font-semibold text-gray-500 ">Quantité en stock</h1>
      <span class="w-[40%] mx-auto block h-[1px] bg-green-400 my-2 opacity-20"></span>
      <span class="font-extrabold text-5xl text-green-500">{{ $produit->quantite }}</span>
    </div>
    <div class="bg-white shadow-md rounded-md px-3 py-4 text-center border-4 border-opacity-40 border-gray-500 shadow-white">
      <h1 class="text-xl font-semibold text-gray-500 ">Prix d'achat</h1>
      <span class="w-[40%] mx-auto block h-[1px] bg-gray-400 my-2 opacity-20"></span>
      <span class="font-extrabold text-5xl text-gray-500">{{ number_format($produit->prix_achat, 0, ',', '  ') }} FCFA</span>
    </div>
    <div class="bg-white shadow-md rounded-md px-3 py-4 text-center border-4 border-opacity-40 border-cyan-500 shadow-white">
      <h1 class="text-xl font-semibold text-gray-500 ">Fournisseur</h1>
      <span class="w-[40%] mx-auto block h-[1px] bg-cyan-400 my-2 opacity-20"></span>
      <span class="font-extrabold text-5xl text-cyan-500">{{ $produit->fournisseur->nom }}</span>
    </div>
  </div>

  <div class="flex mt-4">
    <a href="{{ route('appro.index')  }}" class="px-4 rounded-md text-xs bg-cyan-500 text-white py-1 border-4 uppercase font-bold hover:bg-cyan-600 transition-all active:scale-[.90] border-cyan-600 mr-4">Ajouter une entrer <i class="las la-clock text-sm text-white ml-1"></i></a>
    <a href="{{ route('appro.index')  }}" class="px-4 rounded-md text-xs bg-red-500 text-white py-1 border-4 uppercase font-bold hover:bg-red-600 transition-all active:scale-[.90] border-red-600 mr-4">Ajouter une sortie <i class="las la-clock text-sm text-white ml-1"></i></a>
  </div>

  <h1 class="text-xl pt-4 font-extrabold text-gray-500 mt-4">
    <span># Historique d'entrée/sotie :  </span>
    <span  class="text-cyan-500 "> {{ $totalApproEntrer }} Entrée(s) | {{ $totalApproSortie }} sortie(s)</span>
  </h1>

  <table class="min-w-full divide-y divide-gray-200 mt-3">
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
            <th scope="col" class="p-4 text-left  font-medium text-gray-500 uppercase tracking-wider">

            </th>
        </tr>
    </thead>
    <tbody class="bg-white">
        @foreach ($produit->approvisionnements as $key => $approvisionnement)
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

</x-dashboard-layout>