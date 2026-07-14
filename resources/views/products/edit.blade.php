<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Ažuriranje proizvoda
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 shadow rounded">

                <form
                    action="{{ route('products.update', $product) }}"
                    method="POST" enctype="multipart/form-data"
                >
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="font-semibold mb-1 labedit">Naziv</label>

                        <input
                            type="text"
                            name="naziv"
                            value="{{ old('naziv',$product->naziv) }}"
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
                        >{{ old('opis',$product->opis) }}</textarea>

                    </div>

                    <div class="mb-4">
                        <label class="font-semibold mb-1 labedit">Cijena</label>

                        <input
                            type="number"
                            step="0.01"
                            name="cijena"
                            value="{{ old('cijena',$product->cijena) }}"
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
                            value="{{ old('kolicina',$product->kolicina) }}"
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
                            {{ old('category_id',$product->category_id)==$category->id ? 'selected' : '' }}
                            >
                            {{ $category->naziv }}
                        </option>
                        
                        @endforeach
                        </select>

                        @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <x-input-label for="slika" value="Slika proizvoda" class="mb-1"/>
                        @if ($product->slika)
                            <div class="mb-4 rounded-lg border border-gray-200 gb-gray-50 p-4">
                                <p class="mb-2 text-sm font-semibold text-gray-700">
                                    Trenutna slika
                                </p>
                                <img src="{{ asset('storage/'.$product->slika) }}" alt="Slika proizvoda {{ $product->naziv }}"
                                class="h-48 w-auto rounded-lg border border-gray-300 object-contain shadow-sm">
                            </div>
                        @else
                        <div class="mb-4 rounded-md bg-gray-100 p-3 text-sm text-gray-600">
                            Proizvod trenutačno nema spremljenu sliku.
                        </div>
                        @endif

                        <input id="slika" type="file" name="slika" accept=".jpg,.jpeg,.png,.gif"
                        class="block w-full rounded-md border border-gray-300 bg-white p-2 text-sm shadow-sm">

                        @if ($product->slika)
                        <p class="mt-1 text-xs text-gray-500">
                            Odabirom nove datoteke postojeća slika bit će zamijenjenja.
                        </p>
                        @else
                        <p class="mt-1 text-xs text-gray-500">
                            Dopušteni formati: JPG, JPEG, PNG i GIF. Najveća veličina: 2 MB.
                        </p>
                        @endif
                    </div>
    

                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded"
                    >
                        Ažuriraj
                    </button>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>