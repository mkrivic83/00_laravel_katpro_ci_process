<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Novi proizvod
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 shadow rounded">

                <form
                    action="{{ route('products.store') }}"
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

                    <div class="mb-4">
                        <label class="font-semibold mb-1 labedit">Cijena</label>

                        <input
                            type="number"
                            step="0.01"
                            name="cijena"
                            value="{{ old('cijena') }}"
                            class="w-full rounded border-gray-300"
                        >

                        @error('cijena')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="font-semibold mb-1 labedit">Količina</label>

                        <input
                            type="number"
                            name="kolicina"
                            value="{{ old('kolicina') }}"
                            class="w-full rounded border-gray-300"
                        >

                        @error('kolicina')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="font-semibold mb-1 labedit">Kategorija</label>

                        <select
                            id="category_id"
                            name="category_id"
                            value="{{ old('kolicina') }}"
                            class="w-full rounded border-gray-300"
                        >
                        <option value="">
                            -- Odaberite kategoriju --
                        </option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                            {{ old('category_id')==$category->id ? 'selected' : '' }}
                            >
                            {{ $category->naziv }}
                        </option>
                        
                        @endforeach
                        </select>

                        @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
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