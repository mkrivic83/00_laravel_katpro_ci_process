@php
use Carbon\carbon;
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Upravljanje proizvodima - DB klasa
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
                                    <th>Kreiran</th>
                                    <th>Ažuriran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->naziv }}</td>
                                    <td>{{ $product->kategorija }}</td>
                                    <td>{{ $product->kolicina }}</td>
                                    <td>{{ $product->cijena }}</td>                          
                                    <td>{{ Carbon::parse($product->created_at)->format('d.m.Y H:i:s') }}</td>
                                    <td>{{ Carbon::parse($product->updated_at)->format('d.m.Y H:i:s') }}</td>                                 
                                </tr>
                                
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>