<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalji kategorije
        </h2>
    </x-slot>

     <div class="py-6">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <table class="admin-table">
                        <tr>
                            <td>ID</td>
                            <td>{{ $category->id }}</td>
                        </tr>
                        <tr>
                        <td>Naziv</td>
                            <td>{{ $category->naziv }}</td>
                        </tr>
                        <td>Opis</td>
                            <td>{{ $category->opis }}</td>
                        </tr>
                        <td>Kreirana</td>
                            <td>{{ $category->created_at?->format('d.m.Y H:i:s')}}</td>
                        </tr>
                        <td>Ažurirana</td>
                            <td>{{ $category->updated_at?->format('d.m.Y H:i:s')}}</td>
                        </tr>                                                                    
                    </table>
                    <div class="mt-6 flex gap-4">
                        <a href="{{ route('categories.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                            Povratak
                        </a>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>