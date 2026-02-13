<div class="flex flex-col gap-6">
    <x-auth-header title="Crear cuenta" description="Ingresá tus datos para registrarte" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-5">
        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Nombre</label>
            <input
                type="text"
                id="name"
                wire:model="name"
                required
                autofocus
                autocomplete="name"
                placeholder="Nombre completo"
                class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
            />
            @error('name') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Correo electrónico</label>
            <input
                type="email"
                id="email"
                wire:model="email"
                required
                autocomplete="email"
                placeholder="email@example.com"
                class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
            />
            @error('email') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Contraseña</label>
            <input
                type="password"
                id="password"
                wire:model="password"
                required
                autocomplete="new-password"
                placeholder="Contraseña"
                class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
            />
            @error('password') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1.5">Confirmar contraseña</label>
            <input
                type="password"
                id="password_confirmation"
                wire:model="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Confirmar contraseña"
                class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
            />
            @error('password_confirmation') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
        </div>

        <button
            type="submit"
            class="w-full px-4 py-3 rounded-lg bg-gradient-to-br from-fuchsia-600 to-indigo-600 text-white font-semibold shadow-lg shadow-indigo-500/20 hover:scale-[1.02] active:scale-95 transition focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
            Crear cuenta
        </button>
    </form>

    @if (Route::has('login'))
        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-slate-600">
            <span>¿Ya tenés cuenta?</span>
            <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-700" wire:navigate>Iniciar sesión</a>
        </div>
    @endif
</div>
