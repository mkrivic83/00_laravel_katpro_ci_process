<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Unos novog kategorije
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 shadow rounded">

                <form
                    action="{{ route('categories.store') }}"
                    method="POST"
                >
                    @csrf

                    <div class="mb-4">
                        <label class="font-semibold mb-1 labedit">Naziv</label>

                        <input
                            type="text"
                            name="naziv"
                            value="{{ old('naziv') }}"
                            class="w-full rounded border-gray-300"
                        >

                        @error('naziv')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="font-semibold mb-1">Opis</label>

                        <textarea
                            name="opis"
                            class="w-full rounded border-gray-300"
                        >{{ old('opis') }}</textarea>

                    </div>

                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded"
                    >
                        Spremi
                    </button>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>