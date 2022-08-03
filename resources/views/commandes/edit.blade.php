<x-dashboard-layout>
  <div class="flex items-center justify-between">
    <h1 class="text-2xl border-b pb-4 font-extrabold text-gray-500">
      <span># Editer la </span>
      <span class="text-cyan-500">commande</span>
    </h1>

    <div>
      <button class="px-4 rounded-md bg-gray-500 text-white py-1 border-4 uppercase font-bold hover:bg-gray-600 transition-all active:scale-[.90] border-gray-600">Imprimer le reçu</button>
      @if ($commande->etat !== 'PAYER')
        <form action="{{ route('commande.payer',$commande) }}" method="post" class="inline">
          @csrf
          <button type="submit" class="px-4 rounded-md bg-green-500 text-white py-1 border-4 uppercase font-bold hover:bg-green-600 transition-all active:scale-[.90] border-green-600">payer la commande</button>
        </form>
      @else
        <div class="relative">
          <div class="p-4  bg-green-100 font-extrabold text-xl uppercase text-center text-green-500 absolute  right-0 top-[14px]">Déjà payé</div>
        </div>
      @endif
    </div>
  </div>
  
  <div id="commandeEdit" data-id="{{ $commande->id }}"></div>
  
</x-dashboard-layout>