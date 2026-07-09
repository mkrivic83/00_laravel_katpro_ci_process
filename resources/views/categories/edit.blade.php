<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Uređivanje kategorije
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 shadow rounded">

                <form
                    action="{{ route('categories.update', $category) }}"
                    method="POST"
                >

                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="font-semibold mb-1 labedit">Naziv</label>

                        <input
                            type="text"
                            name="naziv"
                            value="{{ old('naziv', $category->naziv) }}"
                            class="w-full rounded border-gray-300"
                        >
                    </div>

                    <div class="mb-4">
                        <label class="font-semibold mb-1">Opis</label>

                        <textarea
                            name="opis"
                            class="w-full rounded border-gray-300"
                        >{{ old('opis',$category->opis) }}</textarea>

                    </div>

                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded"
                    >
                        Ažuriraj kategoriju
                    </button>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>