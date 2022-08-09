<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-between border-b pb-4">
        <h1 class="text-2xl  font-extrabold text-gray-500">
            <span># Dashboard </span>
        </h1>
      </div>
    
      <div class="grid grid-cols-3 gap-4 py-3 border-b border-t">
        <div class="bg-white shadow-md rounded-md px-4 py-4 text-center border-4 border-opacity-40 border-green-500 shadow-white">
          <h1 class="text-xl font-semibold text-gray-500 ">Montant total en caisse</h1>
          <span class="w-[40%] mx-auto block h-[1px] bg-green-400 my-2 opacity-20"></span>
          <span class="font-extrabold text-4xl text-green-500">{{ number_format($totalMontantCaisse, 0, ',', '  ') }} FCFA</span>
        </div>
        <div class="bg-white shadow-md rounded-md px-4 py-4 text-center border-4 border-opacity-40 border-cyan-500 shadow-white">
            <h1 class="text-xl font-semibold text-gray-500 ">Total commande</h1>
            <span class="w-[40%] mx-auto block h-[1px] bg-cyan-400 my-2 opacity-20"></span>
            <span class="font-extrabold text-5xl text-cyan-500">{{ $totalCommande }}</span>
        </div>
        <div class="bg-white shadow-md rounded-md px-4 py-4 text-center border-4 border-opacity-40 border-gray-500 shadow-white">
            <h1 class="text-xl font-semibold text-gray-500 ">Total client</h1>
            <span class="w-[40%] mx-auto block h-[1px] bg-gray-400 my-2 opacity-20"></span>
            <span class="font-extrabold text-5xl text-gray-500">{{ number_format($totalClient, 0, ',', '  ') }}</span>
        </div>
        <div class="bg-white shadow-md rounded-md px-4 py-4 text-center border-4 border-opacity-40 border-orange-500 shadow-white">
            <h1 class="text-xl font-semibold text-orange-500 ">Total produit</h1>
            <span class="w-[40%] mx-auto block h-[1px] bg-orange-400 my-2 opacity-20"></span>
            <span class="font-extrabold text-5xl text-orange-500">{{ number_format($totalProduit, 0, ',', '  ') }}</span>
        </div>
        <div class="bg-white shadow-md rounded-md px-4 py-4 text-center border-4 border-opacity-40 border-blue-500 shadow-white">
            <h1 class="text-xl font-semibold text-blue-500 ">Total Fournisseur</h1>
            <span class="w-[40%] mx-auto block h-[1px] bg-blue-400 my-2 opacity-20"></span>
            <span class="font-extrabold text-5xl text-blue-500">{{ number_format($totalFournisseur, 0, ',', '  ') }}</span>
        </div>
        <div class="bg-white shadow-md rounded-md px-4 py-4 text-center border-4 border-opacity-40 border-violet-500 shadow-white">
            <h1 class="text-xl font-semibold text-violet-500 ">Total type de vêtement</h1>
            <span class="w-[40%] mx-auto block h-[1px] bg-violet-400 my-2 opacity-20"></span>
            <span class="font-extrabold text-5xl text-violet-500">{{ number_format($totalTypeVetement, 0, ',', '  ') }}</span>
        </div>
      </div>
</x-dashboard-layout>
