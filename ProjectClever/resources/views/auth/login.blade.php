<!-- login.blade.php -->
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h1 class="text-[80px] font-bold text-primary mb-8">Log in</h1>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-primary" />
            <x-text-input id="email"
                class="block mt-2 w-full rounded-md border-primary shadow-sm focus:border-primary focus:ring-primary"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-primary" />
            <x-text-input id="password"
                class="block mt-2 w-full rounded-md border-primary shadow-sm focus:border-primary focus:ring-primary"
                type="password"
                name="password"
                required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-primary text-blue-600 shadow-sm focus:ring-primary" name="remember">
                <span class="ms-2 text-sm text-primary">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-primary hover:text-blue-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div>
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-xl font-medium text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                {{ __('Log in') }}
            </button>
        </div>

        <div class="text-center">
            <span class="text-xl text-primary">Belum punya akun? </span>
            <a href="{{ route('register') }}" class="text-xl text-primary hover:text-blue-500">Sign up</a>
        </div>
    </form>
</x-guest-layout>