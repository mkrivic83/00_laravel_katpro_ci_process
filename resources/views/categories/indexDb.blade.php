@php
use Carbon\Carbon;
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Upravljanje kategorijama - DB klasa
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
                    <h3 class="text-lg font-semibold mb-4">Popis kategorija</h3>

                    @can('admin-access')
                    <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                   <i class="bi bi-plus-circle"></i>    
                    Nova kategorija
                    </a>

                    @endcan
                </div>
                    <div class="admin-table-wrapper">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Naziv</th>
                                    <th>Opis</th>
                                    <th>Kreirana</th>
                                    <th>Ažurirana</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->naziv }}</td>
                                    <td>{{ $category->opis }}</td>
                                    <td>{{ Carbon::parse($category->created_at)->format('d.m.Y H:i:s') }}</td>
                                    <td>{{ Carbon::parse($category->updated_at)->format('d.m.Y H:i:s') }}</td>                                                         
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>