<x-dashboard-layout>
    <div class="flex items-center justify-between border-b pb-4">
        <h1 class="text-2xl  font-extrabold text-gray-500">
            <span># Type de vêtement </span>
        </h1>
        <a data-modal-toggle="add-modal" target="_blank" class="px-4 rounded-md text-xs bg-cyan-500 text-white py-1 border-4 uppercase font-bold hover:bg-cyan-600 transition-all active:scale-[.90] border-cyan-600">Ajouter un nouveau type</a>
    </div>
  
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    date
                </th>
                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    nom du type
                </th>
                <th scope="col" class="p-4 text-left  font-medium text-gray-500 uppercase tracking-wider">

                </th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @foreach ($typeVetements as $key => $type)
                <tbody x-data="{ open: false }">
                    <tr class="{{ $key % 2 === 0 ? '' : 'bg-gray-50' }}">
                        <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                            {{ \Carbon\Carbon::parse($type->created_at)->isoFormat('DD-MM-YYYY HH:mm:ss') ?? '' }}
                        </td>
                        <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                            {{ $type->name }}
                        </td>
                        <td class="p-4 flex items-center justify-center">
                            <span @click="open = !open" href="#" class="bg-orange-100 px-2 py-0.5 rounded-md text-orange-500 mr-3">edit</span>
                            <form action="{{ route('vetement_type.delete',$type->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('voulez vous vraiment supprimer ?')"  class="delete-btn px-4  py-1 text-sm inline-block cursor-pointer rounded-md text-white bg-red-400">supprimer</button>
                            </form>
                        </td>
                    </tr>
                    <tr x-show="open">
                        <form action="{{ route('vetement_type.update',$type->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                <input type="text" class="border-2 border-gray-200 outline-none focus:ring-0 focus:outline-none focus:border-gray-200 py-2  bg-gray-50  rounded-md disabled " value="{{ \Carbon\Carbon::parse($type->created_at)->isoFormat('DD-MM-YYYY HH:mm:ss') ?? '' }}" disabled>
                            </td>
                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                <input type="text" name="name" class="border-2 border-gray-200 outline-none focus:ring-0 focus:outline-none focus:border-gray-200 py-2  bg-gray-50  rounded-md " value="{{ $type->name }} " >
                            </td>
                            <td class="p-4 flex items-center justify-center">
                                <button class="p-2 bg-cyan-600 text-white rounded-md border-2 border-cyan-700">sauvegarder</button>
                            </td>
                        </form>
                    </tr>
                </tbody>

            @endforeach
            
        </tbody>
    </table>
    <div class="px-4 border-t pt-2">
        {{ $typeVetements->links() }}
    </div>

    <!-- Modal -->
    <div class="hidden overflow-x-hidden overflow-y-auto fixed top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center h-modal sm:h-full"
    id="add-modal">
        <div class="relative w-full max-w-2xl px-4 h-full md:h-auto">
            <div class="bg-white rounded-lg shadow relative">
                <div class="flex items-start justify-between p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold">
                        Nouvel type
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                        data-modal-toggle="add-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>

                <div class="p-6 space-y-6">
                    <form action="{{ route('vetement_type.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="col-span-2 sm:col-span-3">
                            <label for="name" class="text-sm font-medium text-gray-900 block mb-2">name </label>
                            
                            <input type="text" min="1" name="name" id="name"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                            placeholder="Nom du type de vêtement" required>

                            <div class="text-red-400">@error('name') {{ $message }} @enderror</div>
                        </div>
                </div>

                <div class="items-center p-6 border-t border-gray-200 rounded-b">
                    <button
                        class="text-white w-full bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                        type="submit">Enregistrer le nouveau type</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
</x-dashboard-layout>