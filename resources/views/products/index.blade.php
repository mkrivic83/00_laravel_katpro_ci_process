<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Upravljanje proizvodima
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))

            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
            
            @endif
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold mb-4">Popis proizvoda i kategorija</h3>

                    @can('admin-access')
                    <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                   <i class="bi bi-plus-circle"></i>    
                    Novi proizvod
                    </a>

                    @endcan
                </div>
                    <div class="admin-table-wrapper">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Naziv</th>
                                    <th>Kategorija</th>
                                    <th>Količina</th>
                                    <th>Cijena</th>
                                    <th>Detalji</th>
                                    <th>Kreirana</th>
                                    <th>Ažurirana</th>
                                    <th>Izvor</th>
                                    @can('admin-access')
                                    <th>Akcije</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->naziv }}</td>
                                    <td>{{ $product->category->naziv }}</td>
                                    <td>{{ $product->kolicina }}</td>
                                    <td>{{ $product->cijena }}</td>
                                    <td>
                                        <a href="{{ route('products.show',$product) }}"
                                        class="icon-button icon-edit" title="Detalji"
                                        >
                                         <i class="bi bi-eye"></i>
                                    </a>
                                    </td>
                                    <td>{{ $product->created_at?->format('d.m.Y H:i:s') }}</td>
                                    <td>{{ $product->updated_at?->format('d.m.Y H:i:s') }}</td>
                                    <td>{{ $product->izvor }}</td>
                                    @can('admin-access')
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('products.edit',$product) }}" class="icon-button icon-edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('products.destroy',$product) }}"
                                            method="POST" onsubmit="return confirm('Obrisati proizvod?')"
                                            >
                                             @csrf
                                             @method('DELETE')
                                             <button type="submit" class="icon-button icon-delete" title="Obriši">
                                                <i class="bi bi-trash"></i>
                                             </button>  
                                            </form>
                                        </div>
                                    </td>
                                    @endcan
                                </tr>
                                
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>