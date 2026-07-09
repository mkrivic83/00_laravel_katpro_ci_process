<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Uređivanje korisnika
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 shadow rounded">

                <form
                    action="{{ route('admin.users.update', $user) }}"
                    method="POST"
                >

                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="font-semibold mb-1 labedit">Ime</label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            class="w-full rounded border-gray-300"
                        >
                    </div>

                    <div class="mb-4">
                        <label class="font-semibold mb-1">Email</label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            class="w-full rounded border-gray-300"
                        >
                    </div>

                    <div class="mb-4">
                        <label class="font-semibold mb-1">Datum rođenja</label>

                        <input
                            type="date"
                            name="datum_rod"
                            value="{{ old('datum_rod', $user->datum_rod?->format('Y-m-d')) }}"
                            class="w-full rounded border-gray-300"
                        >
                    </div>

                    <div class="mb-4">
                        <label class="font-semibold mb-1">Plaća</label>

                        <input
                            type="number"
                            step="0.01"
                            name="placa"
                            value="{{ old('placa', $user->placa) }}"
                            class="w-full rounded border-gray-300"
                        >
                    </div>

                    <div class="mb-4">
                        <label class="font-semibold mb-1">Administrator</label>

                        <select
                            name="isAdmin"
                            class="w-full rounded border-gray-300"
                        >
                            <option value="0"
                                {{ !$user->isAdmin ? 'selected' : '' }}>
                                Ne
                            </option>

                            <option value="1"
                                {{ $user->isAdmin ? 'selected' : '' }}>
                                Da
                            </option>
                        </select>
                    </div>

                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded"
                    >
                        Spremi promjene
                    </button>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>