<x-app-layout>
    <x-slot name="header">
        <h2>
            Greška
        </h2>
    </x-slot>

    <div class="error-container">

        <div class="error-box">

         
        <h3 class="error-title">
            Nemate pravo pristupa
        </h3>

        <p class="error-text">
            Ovaj dio je dostupan samo ovlaštenim korisnicima
        </p>

        <a href="{{ route('dashboard') }}" class="note-button">Povratak na dashboard</a>
        </div>
    </div>
</x-app-layout>