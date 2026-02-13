<x-layouts.admin>
    <x-slot name="title">Usuarios</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Usuarios</li>
    </x-slot>

    @livewire('admin.usuarios')
</x-layouts.admin>
