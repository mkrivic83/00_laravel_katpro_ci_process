<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Upravljanje proizvodima sa dummy servisa
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
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product['id'] }}</td>
                                    <td>{{ $product['title'] }}</td>
                                    <td>{{ $product['category']}}</td>
                                    <td>{{ $product['stock']}}</td> 
                                    <td>{{ $product['price']}}</td>                                                                                        
                                    <td>
                                        @if ($product['saved'])
                                        <span class="badge-admin">
                                            Spremljeno
                                        </span>
                                        @else
                                            <form action="{{ route('dummy-products.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="title" value="{{ $product['title'] }}">
                                                <input type="hidden" name="description" value="{{ $product['description'] }}">
                                                <input type="hidden" name="price" value="{{ $product['price'] }}">
                                                <input type="hidden" name="stock" value="{{ $product['stock'] }}">
                                                <input type="hidden" name="category" value="{{ $product['category'] }}">
                                                <button type="submit" 
                                                class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                                                Spremi
                                                </button>
                                            </form>
                                        @endif
                                    </td>                                                                                        
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