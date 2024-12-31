<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <h1 class="text-[80px] font-bold text-primary mb-8">Sign Up</h1>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-primary" />
            <x-text-input id="name" class="block mt-1 border-primary focus:border-primary focus:ring-primary w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-primary" />
            <x-text-input id="email" class="block mt-1 border-primary focus:border-primary focus:ring-primary w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role Selection -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Register as')" class="text-primary" />
            <select id="role" name="role" class="block mt-1 w-full border-primary rounded-md shadow-sm focus:border-primary focus:ring-primary" required>
                <option value="" disabled selected>Select your role</option>
                <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>Client</option>
                <option value="freelancer" {{ old('role') == 'freelancer' ? 'selected' : '' }}>Freelancer</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-primary"/>
            <x-text-input id="password" class="block mt-1 w-full border-primary focus:border-primary focus:ring-primary"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-primary" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full border-primary focus:border-primary focus:ring-primary"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-xl font-medium text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                {{ __('Sign Up') }}
            </button>
        </div>

        <div class="mt-4 text-center">
            <span class="text-xl text-primary">Sudah punya akun? </span>
            <a href="{{ route('login') }}" class="text-xl text-primary hover:text-blue-500">Log in</a>
        </div>
    </form>
</x-guest-layout>
