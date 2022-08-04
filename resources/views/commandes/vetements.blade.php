<x-dashboard-layout>
  @if (Session::has('success'))
    <div class="p-3 rounded-md bg-green-100 text-green-400 text-2xl text-center font-extrabold">{{ session('success') }}</div>
  @endif

  <div class="p-4 shadow rounded-md bg-white">
    <div class="flex justify-between items-center">
      <h1 class="text-2xl border-b  font-extrabold text-gray-500">
        <span>#Commade de </span>
        <span class="text-cyan-500">{{ $commande->client->nom }} {{ $commande->client->prenom }}</span> | 
        <span class="">
          {{ Help\Helper::getTotalVetement($commande) }} Vêtement{{ Help\Helper::getTotalVetement($commande) > 1 ? 's':'' }} | {{ $commande->cout_total }} F
        </span>
      </h1>

      <a class="px-4 py-2 border-2 uppercase font-semibold text-sm bg-gray-500 text-white rounded-md" href="{{ route('commande.edit',$commande) }}">voir la commande</a>
    </div>

  <div class="mt-4">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50 border-b">
          <tr>
            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Quantité
            </th>
            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              type de vêtement
            </th>
            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                statut
            </th>
            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                service demander
            </th>
            <th>
              
            </th>
          </tr>
      </thead>
      <tbody class="bg-white">
        @foreach ($commande->vetements as $key => $vetement)

          <tbody class="border-none" x-data="{ open: false }" key="{{ $key }}">
            <tr>
              <td class="p-4 text-sm font-normal text-gray-900">
                <span class="font-semibold">{{ $vetement->quantite }}</span>
              </td>
              <td class="p-4 text-sm font-normal text-gray-900">
                <span class="font-semibold">{{ $vetement->typeVetement->name }}</span>
              </td>
              <td class="p-4 text-sm font-normal">
                {{ $vetement->statut }}
              </td>
              <td class="p-4 text-sm font-semibold text-gray-900">
                {{ $vetement->service_demander }}
              </td>
              <td class="p-4 justify-start">

                <form action="{{ route('commande.vetementDelete',[$commande,$vetement]) }}" class="inline" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="bg-red-100 cursor-pointer inline-block text-sm text-red-400 px-3 py-1 rounded-md">supprimer</button>
                </form>

                <span @click="open = !open" class="bg-orange-100 cursor-pointer inline-block text-sm text-orange-400 px-3 py-1 rounded-md">editer</span>
              
              </td>
            </tr>
            <tr x-show="open">
              <td colspan="5" class="p-4 bg-gray-50">
                <form class="inline-flex w-full" action="{{ route('commande.vetementStore') }}" method="post">
                  @csrf
                  @method('POST')
                  <input name="vetement_id" type="hidden" hidden value="{{ $vetement->id }}">
                  <div class="w-[90%] flex">
                    <div class="w-1/4 px-1">
                      <input type="number" value="{{ old('quantite',$vetement->quantite) }}" class="w-full px-3 py-1 rounded-md" name="quantite">
                    </div>
                    <div class="w-1/4 px-1">
                      <select name="type_vetement_id" placeholder="type" class="w-full px-3 py-1 rounded-md">
                        @foreach ($typeVetements as $type)
                          <option @selected($vetement->typeVetement->name === $type->name ) value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="w-1/4 px-1">
                      <select name="statut" placeholder="type" class="w-full px-3 py-1 rounded-md">
                        <option @selected($vetement->statut === 'REÇU' ) value="REÇU">Réçu</option>
                        <option @selected($vetement->statut === 'EN_COURS_DE_LAVAGE' ) value="EN_COURS_DE_LAVAGE">En cour de lavage</option>
                        <option @selected($vetement->statut === 'LAVÉ' ) value="LAVÉ">lavé</option>
                        <option @selected($vetement->statut === 'EN_COURS_DE_REPASSAGE' ) value="EN_COURS_DE_REPASSAGE">En cour de repassage</option>
                        <option @selected($vetement->statut === 'REPASSÉ' ) value="REPASSÉ">répassé</option>
                        <option @selected($vetement->statut === 'TERMINÉ' ) value="TERMINÉ">Terminé</option>
                      </select>
                    </div>
                    <div class="w-1/4 px-1">
                      <select name="service_demander" placeholder="type" class="w-full px-3 py-1 rounded-md">
                        <option @selected($vetement->service_demander === 'LAVAGE' ) value="LAVAGE">Lavage</option>
                        <option @selected($vetement->service_demander === 'LAVAGE_REPASSAGE' ) value="LAVAGE_REPASSAGE">Lavage et répassage</option>
                      </select>
                    </div>
                  </div>
                  <button class="w-[10%] px-3 py-1 bg-cyan-700 text-white rounded-md">
                    modifier
                  </button>
                </form>
              </td>
            </tr>
          </tbody>
          
        @endforeach
        
      </tbody>
    </table>
  </div>
</x-dashboard-layout>
