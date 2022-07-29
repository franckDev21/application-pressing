<x-dashboard-layout>
  <div class="text-gray-400 mb-4">
    <a class="hover:underline" href="{{ route('client.index') }}">Gestion des clients </a> >
    <span class="">Modification des informations du client </span> > 
    <span class="text-cyan-600">{{ $client->nom." ".$client->prenom }} </span>
  </div>

  <form action="{{ route('client.update',$client->id) }}" method="POST" class="bg-white pt-4 pb-6 rounded-lg">
    @method('PATCH')
    @csrf
    <div class="flex px-3">
      <div class="w-1/2 px-2">
        <label for="" class="mb-3 inline-block text-gray-500">Nom du client</label>
        <input name="nom" value="{{ old('nom',$client->nom) }}" type="text" placeholder="Nom" class="border-2 border-gray-200 outline-none focus:ring-0 focus:outline-none focus:border-gray-200 py-2 w-full bg-gray-50  rounded-md ">
        <div class="text-red-400">@error('nom') {{ $message }} @enderror</div>
      </div>
      <div class="w-1/2 px-2">
        <label for="" class="mb-3 inline-block text-gray-500">Prénom du client</label>
        <input name="prenom" value="{{ old('prenom',$client->prenom) }}" type="text" placeholder="Prénom" class="border-2 border-gray-200 outline-none focus:ring-0 focus:outline-none focus:border-gray-200 py-2 w-full bg-gray-50  rounded-md ">
        <div class="text-red-400">@error('prenom') {{ $message }} @enderror</div>
      </div>
    </div>
    <div class="flex px-3 mt-4">
      <div class="w-1/2 px-2">
        <label for="" class="mb-3 inline-block text-gray-500">Adresse email</label>
        <input name="email" value="{{ old('email',$client->email) }}" type="email" placeholder="Email" class="border-2 border-gray-200 outline-none focus:ring-0 focus:outline-none focus:border-gray-200 py-2 w-full bg-gray-50  rounded-md ">
        <div class="text-red-400">@error('email') {{ $message }} @enderror</div>
      </div>
      <div class="w-1/2 px-2">
        <label for="" class="mb-3 inline-block text-gray-500">Téléphone</label>
        <input name="tel" value="{{ old('tel',$client->tel) }}" type="tel" placeholder="Numéro de téléphone" class="border-2 border-gray-200 outline-none focus:ring-0 focus:outline-none focus:border-gray-200 py-2 w-full bg-gray-50  rounded-md ">
        <div class="text-red-400">@error('tel') {{ $message }} @enderror</div>
      </div>
    </div>

    <div class="text-center mt-6">
      <button class="px-6 rounded-md font-bold py-2 bg-cyan-600 text-white">Modifier</button>
    </div>
  </form>
</x-dashboard-layout>
