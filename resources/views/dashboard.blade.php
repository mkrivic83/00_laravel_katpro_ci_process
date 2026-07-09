<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p>Vi ste: {{ auth()->user()->name }}</p>
                    <p>E-mail: {{ auth()->user()->email }}</p>
                    <p>Placa: {{ auth()->user()->placa }}</p>
                    <p>Datum rođenja: {{ (auth()->user()->datum_rod)->format('d.m.Y') }}</p>
                    <p>Admin: {{ auth()->user()->isAdmin ? 'Da' : 'Ne' }}</p>
                </div>
                @can('admin-access')
                <div class="p-6 text-gray-900">
                    <a href="{{ route('admin.dashboard') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                        Admin panel
                    </a>
                </div>
                @endcan
            </div>
        </div>
    </div>
</x-app-layout>
