<x-dashboard-layout>

  <div class="flex pb-4 border-b mb-10 items-center justify-between">
    <h1 class="text-2xl font-extrabold text-gray-500">
      <span>#Liste des </span>
      <span class="text-cyan-500">commandes</span> 
    </h1>

    <a  href="{{ route('commande.printCommande') }}" target="_blank" class="px-4 text-xs rounded-md bg-gray-500 text-white py-1 border-4 uppercase font-bold hover:bg-gray-600 transition-all active:scale-[.90] border-gray-600">Imprimer la liste des commandes <i class="las la-download text-sm text-white ml-1"></i></a>
  </div>

  <div id="CommandeTable"></div>

</x-dashboard-layout>
