<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-x text-gray-800 leading-tight">
            Upravljanje korisnicima
        </h2>
    </x-slot>

    <div class="py-6">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                        @if (session('success'))

                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded mt-4">
                            {{ session('success') }}
                        </div>
                        
                        @endif
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Popis korisnika</h3>

                    <div class="admin-table-wrapper">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Naziv</th>
                                    <th>Email</th>
                                    <th>Admin</th>
                                    <th>Datum rođenja</th>
                                    <th>Plaća</th>
                                    <th>Datum ažuriranja</th>
                                    <th>Akcije</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->isAdmin)
                                            <span class="badge-admin">
                                                DA
                                            </span>
                                        @else
                                            <span class="badge-user">
                                                NE
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $user->datum_rod?->format('d.m.Y') }}</td>
                                    <td>
                                        {{ number_format($user->placa,2,',','.') }}
                                    </td>
                                    <td>
                                        {{ $user->updated_at->format('d.m.Y H:i:s') }}
                                    </td>
                                     <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.users.edit',$user) }}" class="icon-button icon-edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="{{ route('admin.users.deletePreview',$user) }}" class="icon-button icon-delete">
                                                <i class="bi bi-trash"></i>
                                            </a>

                                        </div>
                                    </td>
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