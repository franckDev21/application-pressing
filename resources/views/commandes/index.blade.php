<x-dashboard-layout>

  <h1 class="text-2xl border-b pb-4 font-extrabold text-gray-500">
    <span>#Liste des </span>
    <span class="text-cyan-500">commandes</span>
  </h1>

  <table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                prix total
            </th>
            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Date de livraison
            </th>
            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                état
            </th>
            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              client
            </th>
            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              vêtements
            </th>
        </tr>
    </thead>
    <tbody class="bg-white text-gray-600">
        @foreach ($commandes as $key => $commande)
            <tr class="{{ $key % 2 === 0 ? '' : 'bg-gray-50' }}">
                <td class="p-4 whitespace-nowrap text-sm font-normal">
                   <span class="font-extrabold text-gray-500">{{ number_format($commande->cout_total,0,',','  ') }} F</span>
                </td>
                <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                    {{ $commande->date_livraison->format('d M Y') }}
                </td>
                <td class="p-4 whitespace-nowrap text-sm">
                    {{ $commande->etat }}
                </td>
                <td class="p-4 whitespace-nowrap text-sm">
                  <span class="font-semibold">{{ $commande->client->nom.' '.$commande->client->prenom }}</span> <br>
                  <span>{{ $commande->client->email }}</span>
                </td>
                <td class="p-4 whitespace-nowrap text-sm">
                  <span class="font-extrabold text-gray-500">{{ $commande->vetements->count() }} Vêtement{{ $commande->vetements->count() > 1 ? 's':'' }}</span> <br>
                  <a href="{{ route('commande.vetements',$commande) }}" class="text-xs px-2 inline-block py-1 rounded-md text-green-600 bg-green-100 mt-2" >voir l'etat des vêtements</a>
                  
                </td>
            </tr>
        @endforeach
        
    </tbody>
  </table>
  <div class="px-4 border-t pt-2">
      {{ $commandes->links() }}
  </div>
</x-dashboard-layout>
