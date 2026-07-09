<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalji proizvoda
        </h2>
    </x-slot>

     <div class="py-6">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <table class="admin-table">
                        <tr>
                            <td>ID</td>
                            <td>{{ $product->id }}</td>
                        </tr>
                        <tr>
                        <td>Naziv</td>
                            <td>{{ $product->naziv }}</td>
                        </tr>
                        <td>Kategorija</td>
                            <td>{{ $product->category->naziv }}</td>
                        </tr>
                        <td>Opis</td>
                            <td>{{ $product->opis }}</td>
                        </tr>
                        <td>Cijena</td>
                            <td>{{ number_format($product->cijena,2,',','.') }}</td>
                        </tr>
                        <td>Količina</td>
                            <td>{{ $product->kolicina }}</td>
                        </tr>                                                                            
                        <td>Kreiran</td>
                            <td>{{ $product->created_at?->format('d.m.Y H:i:s')}}</td>
                        </tr>
                        <td>Ažuriran</td>
                            <td>{{ $product->updated_at?->format('d.m.Y H:i:s')}}</td>
                        </tr>                                                                    
                    </table>
                    <div class="mt-6 flex gap-4">
                        <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                            Povratak
                        </a>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>