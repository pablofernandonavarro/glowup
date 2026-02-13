<x-layouts.admin>
    <x-slot name="title">GlowUp - Dashboard</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item active">GlowUp - Dashboard</li>
    </x-slot>

    <!-- Info boxes -->
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Usuarios</span>
                    <span class="info-box-number">
                        {{ \App\Models\User::count() }}
                    </span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-check"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Usuarios Activos</span>
                    <span class="info-box-number">{{ \App\Models\User::where('email_verified_at', '!=', null)->count() }}</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-weight"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Registros de Peso</span>
                    <span class="info-box-number">{{ \App\Models\Peso::count() }}</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-shield"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Administradores</span>
                    <span class="info-box-number">{{ \App\Models\User::where('role', 'admin')->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Resumen del Sistema
                    </h3>
                </div>
                <div class="card-body">
                    <div class="tab-content p-0">
                        <p>Bienvenido al panel de administración de {{ config('app.name') }}</p>
                        <p>Desde aquí puedes gestionar todos los aspectos del sistema.</p>
                        <ul>
                            <li>Gestión de usuarios</li>
                            <li>Visualización de estadísticas</li>
                            <li>Control total del sistema</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Right col -->
        <section class="col-lg-5 connectedSortable">
            <!-- Calendar -->
            <div class="card bg-gradient-success">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <i class="far fa-calendar-alt"></i>
                        Accesos Rápidos
                    </h3>
                </div>
                <div class="card-body pt-0">
                    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-light btn-block">
                        <i class="fas fa-users"></i> Gestionar Usuarios
                    </a>
                    <a href="{{ url('/') }}" class="btn btn-light btn-block" wire:navigate="false">
                        <i class="fas fa-home"></i> Volver al Sitio
                    </a>
                </div>
            </div>
        </section>
    </div>
</x-layouts.admin>
