<div class="hidden overflow-x-hidden overflow-y-auto fixed top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center h-modal sm:h-full"
    id="add-user-modal">
    <div class="relative w-full max-w-2xl px-4 h-full md:h-auto">
        <div class="bg-white rounded-lg shadow relative">
            <div class="flex items-start justify-between p-5 border-b rounded-t">
                <h3 class="text-xl font-semibold">
                    Nouvel approvisionnement
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                    data-modal-toggle="add-user-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <div class="p-6 space-y-6">
                <form action="{{ route('appro.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="first-name" class="text-sm font-medium text-gray-900 block mb-2">Produit </label>
                            @if ($edit)
                                <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                                <span class="shadow-sm uppercase bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">{{ $produit->nom }}</span>
                            @else
                            <select required name="produit_id" id="product" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">
                                @foreach ($produits as $produit)
                                    <option @selected($produit->id === old('produit_id') ) value="{{ $produit->id }}">{{ $produit->nom }} | {{ $produit->quantite }} En stock</option>
                                @endforeach
                            </select>
                            @endif
                            
                            <div class="text-red-400">@error('produit_id') {{ $message }} @enderror</div>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="last-name" class="text-sm font-medium text-gray-900 block mb-2">Quantit??</label>
                            <input type="number" min="1" name="quantite" id="last-name"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                placeholder="Ajouter une quantit??" required>
                            <div class="text-red-400">@error('quantite') {{ $message }} @enderror</div>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="email" class="text-sm font-medium text-gray-900 block mb-2">Prix d'achat</label>
                            <input min="1" type="number" name="prix_achat" id="email"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                placeholder="prix" required>
                            <div class="text-red-400">@error('prix_achat') {{ $message }} @enderror</div>
                        </div>
                        <div class="col-span-6 disabled sm:col-span-3">
                            <label for="phone-number" class="text-sm font-medium text-gray-900 block mb-2">Phone
                                Date d'approvisionnement</label>
                            <input value="{{ \Carbon\Carbon::now()->format('Y-m-d')  }}" type="date" name="date" id="phone-number"
                                class="shadow-sm disabled bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                placeholder="Date" required>
                            <div class="text-red-400">@error('date') {{ $message }} @enderror</div>
                        </div>
                    </div>
            </div>

            <div class="items-center p-6 border-t border-gray-200 rounded-b">
                <button
                    class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                    type="submit">Enregistrer</button>
            </div>
            </form>
        </div>
    </div>
</div>
