<x-dashboard-layout>
  <h1 class="text-2xl border-b pb-4 font-extrabold text-gray-500">
    <span>#AJouter un nouveau </span>
    <span class="text-cyan-500">produit</span>
  </h1>

  <form action="{{ route('produit.store') }}" method="POST" class="bg-white pt-4 pb-6 rounded-lg">
    @csrf
    {{-- {{ $errors }} --}}
    <div class="flex px-3">
      <div class="w-1/3 px-2">
        <label for="" class="mb-3 inline-block text-gray-500">Nom du produit</label>
        <input name="nom" value="{{ old('nom') }}" type="text" placeholder="Nom" class="border-2 border-gray-200 outline-none focus:ring-0 focus:outline-none focus:border-gray-200 py-2 w-full bg-gray-50  rounded-md ">
        <div class="text-red-400">@error('nom') {{ $message }} @enderror</div>
      </div>
      <div class="w-1/3 px-2">
        <label for="" class="mb-3 inline-block text-gray-500">Quantite en stock</label>
        <input name="quantite" min="0" value="{{ old('quantite',0) }}" type="number" placeholder="quantité" class="border-2 border-gray-200 outline-none focus:ring-0 focus:outline-none focus:border-gray-200 py-2 w-full bg-gray-50  rounded-md ">
        <div class="text-red-400">@error('quantite') {{ $message }} @enderror</div>
      </div>
      <div class="w-1/3 px-2">
        <label for="" class="mb-3 inline-block text-gray-500">fournisseurs</label>
        <select name="fournisseur_id" placeholder="Fournisseur" class="border-2 px-3 border-gray-200 outline-none focus:ring-0 focus:outline-none focus:border-gray-200 py-2 w-full bg-gray-50  rounded-md ">
          @foreach ($fournisseurs as $fournisseur)
            <option @selected(old('fournisseur_id') == $fournisseur->id) value="{{ $fournisseur->id}}">{{ $fournisseur->nom }}</option>
           @endforeach
        </select>
        <div class="text-red-400">@error('fournisseur_id') {{ $message }} @enderror</div>
      </div>
    </div>
    <div class="flex px-3 mt-4">
      <div class="w-1/2 px-2">
        <label for="" class="mb-3 inline-block text-gray-500">Unité</label>
        <select name="unite" placeholder="unite" class="border-2 px-3 border-gray-200 outline-none focus:ring-0 focus:outline-none focus:border-gray-200 py-2 w-full bg-gray-50  rounded-md " id="">
          <option @selected(old('unite') === 'G' ) value="G">Gramme</option>
          <option @selected(old('unite') === 'KG' ) value="KG">Kilogramme</option>
          <option @selected(old('unite') === 'L' ) value="L">Littre</option>
        </select>
        <div class="text-red-400">@error('unite') {{ $message }} @enderror</div>
      </div>
      <div class="w-1/2 px-2">
        <label for="" class="mb-3 inline-block text-gray-500">Prix d'achat</label>
        <input name="prix_achat" min="1" value="{{ old('prix_achat',100) }}" type="number" placeholder="Prix d'achat du produit" class="px-3 border-2 border-gray-200 outline-none focus:ring-0 focus:outline-none focus:border-gray-200 py-2 w-full bg-gray-50  rounded-md ">
        <div class="text-red-400">@error('prix_achat') {{ $message }} @enderror</div>
      </div>
    </div>

    <div class="text-center mt-6">
      <button class="px-6 rounded-md font-bold py-2 bg-cyan-600 text-white">Ajouter</button>
    </div>
  </form>
</x-dashboard-layout>
