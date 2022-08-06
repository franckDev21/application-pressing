<x-dashboard-layout>
  <h1 class="text-2xl border-b pb-4 font-extrabold text-gray-500">
    <span>#Modification  | </span>
    <span class="text-cyan-500">{{ $fournisseur->nom." ".$fournisseur->prenom }}</span>
  </h1>

  <form action="{{ route('fournisseur.update',$fournisseur) }}" method="POST" class="bg-white pt-4 pb-6 rounded-lg">
    @method('PATCH')
    @csrf
    <div class="flex px-3">
      <div class="w-1/2 px-2">
        <label for="" class="mb-3 inline-block text-gray-500">Nom du client</label>
        <input name="nom" value="{{ old('nom',$fournisseur->nom) }}" type="text" placeholder="Nom" class="border-2 border-gray-200 outline-none focus:ring-0 focus:outline-none focus:border-gray-200 py-2 w-full bg-gray-50  rounded-md ">
        <div class="text-red-400">@error('nom') {{ $message }} @enderror</div>
      </div>
      <div class="w-1/2 px-2">
        <label for="" class="mb-3 inline-block text-gray-500">Prénom du client</label>
        <input name="address" value="{{ old('address',$fournisseur->address) }}" type="text" placeholder="Adresse" class="border-2 border-gray-200 outline-none focus:ring-0 focus:outline-none focus:border-gray-200 py-2 w-full bg-gray-50  rounded-md ">
        <div class="text-red-400">@error('address') {{ $message }} @enderror</div>
      </div>
    </div>
    <div class="flex px-3 mt-4">
      <div class="w-1/2 px-2">
        <label for="" class="mb-3 inline-block text-gray-500">Adresse email</label>
        <input name="email" value="{{ old('email',$fournisseur->email) }}" type="email" placeholder="Email" class="border-2 border-gray-200 outline-none focus:ring-0 focus:outline-none focus:border-gray-200 py-2 w-full bg-gray-50  rounded-md ">
        <div class="text-red-400">@error('email') {{ $message }} @enderror</div>
      </div>
      <div class="w-1/2 px-2">
        <label for="" class="mb-3 inline-block text-gray-500">Téléphone</label>
        <input name="tel" value="{{ old('tel',$fournisseur->tel) }}" type="tel" placeholder="Numéro de téléphone" class="border-2 border-gray-200 outline-none focus:ring-0 focus:outline-none focus:border-gray-200 py-2 w-full bg-gray-50  rounded-md ">
        <div class="text-red-400">@error('tel') {{ $message }} @enderror</div>
      </div>
    </div>

    <div class="text-center mt-6">
      <button class="px-6 rounded-md font-bold py-2 bg-cyan-600 text-white">Modifier</button>
    </div>
  </form>
</x-dashboard-layout>
