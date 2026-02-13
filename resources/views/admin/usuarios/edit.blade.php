<x-layouts.admin>
    <x-slot name="title">Editar Usuario</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.usuarios.index') }}">Usuarios</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </x-slot>

    @livewire('admin.usuario-edit', ['id' => $id])
</x-layouts.admin>
