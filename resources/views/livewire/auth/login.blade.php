<div class="flex flex-col gap-6">
    <x-auth-header title="Iniciar sesión" description="Ingresá tu email y contraseña para acceder" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="login" class="flex flex-col gap-5">
        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Correo electrónico</label>
            <input
                type="email"
                id="email"
                wire:model="email"
                required
                autofocus
                autocomplete="email"
                placeholder="email@example.com"
                class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
            />
            @error('email') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="block text-sm font-medium text-slate-700">Contraseña</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs text-indigo-600 hover:text-indigo-700 font-medium" wire:navigate>
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>
            <input
                type="password"
                id="password"
                wire:model="password"
                required
                autocomplete="current-password"
                placeholder="Contraseña"
                class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
            />
            @error('password') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input
                type="checkbox"
                id="remember"
                wire:model="remember"
                class="size-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
            />
            <label for="remember" class="ml-2 text-sm text-slate-700">Recordarme</label>
        </div>

        <button
            type="submit"
            class="w-full px-4 py-3 rounded-lg bg-gradient-to-br from-fuchsia-600 to-indigo-600 text-white font-semibold shadow-lg shadow-indigo-500/20 hover:scale-[1.02] active:scale-95 transition focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
            Iniciar sesión
        </button>
    </form>

    @if (Route::has('register'))
        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-slate-600">
            <span>¿No tenés cuenta?</span>
            <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-700" wire:navigate>Registrarse</a>
        </div>
    @endif
</div>
