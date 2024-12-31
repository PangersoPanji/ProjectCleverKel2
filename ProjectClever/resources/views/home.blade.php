<x-layouts.app>
    @auth
        @if(auth()->user()->role === 'freelancer')
            <!-- Freelancer View -->
            <div class="bg-white">
                <!-- Hero Section -->
                <div class="relative isolate px-6 pt-14 lg:px-8">

                    <div class="mx-auto max-w-3xl py-32 sm:py-48">
                        <div class="text-center">
                            <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
                                Showcase Your Creativity.
                            </h1>
                            <h2 class="mt-6 text-2xl font-bold tracking-tight text-gray-900">
                                Attract the Right Opportunities.
                            </h2>
                            <p class="mt-6 text-lg leading-8 text-gray-600">
                                Get Started and Shine Today!
                            </p>
                            <div class="mt-10 flex items-center justify-center gap-x-6">
                                <a href="{{ route('services.create') }}"
                                   class="rounded-md bg-primary px-6 py-3 text-lg font-semibold text-white shadow-sm hover:bg-blue-500">
                                    Post a Service
                                </a>
                                <a href="{{ route('services.manage') }}"
                                   class="text-lg font-semibold leading-6 text-gray-900">
                                    Manage Services <span aria-hidden="true">→</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Features Section -->
                <div class="bg-gray-50 py-24 sm:py-32">
                    <div class="mx-auto max-w-7xl px-6 lg:px-8">
                        <div class="mx-auto max-w-2xl lg:text-center">
                            <h2 class="text-base font-semibold leading-7 text-primary">Start Earning</h2>
                            <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                                Everything you need to succeed as a freelancer
                            </p>
                        </div>
                        <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                            <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                                <div class="flex flex-col">
                                    <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900">
                                        <svg class="h-5 w-5 flex-none text-primary" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                                        </svg>
                                        Professional Portfolio
                                    </dt>
                                    <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                                        <p class="flex-auto">Create a stunning portfolio to showcase your best work and attract ideal clients.</p>
                                    </dd>
                                </div>
                                <div class="flex flex-col">
                                    <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900">
                                        <svg class="h-5 w-5 flex-none text-primary" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10.75 10.818v2.614A3.13 3.13 0 0011.888 13c.482-.315.612-.648.612-.875 0-.227-.13-.56-.612-.875a3.13 3.13 0 00-1.138-.432zM8.33 8.62c.053.055.115.11.184.164.208.16.46.284.736.363V6.603a2.45 2.45 0 00-.35.13c-.14.065-.27.143-.386.233-.377.292-.514.627-.514.909 0 .184.058.39.202.592.037.051.08.102.128.152z" />
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-6a.75.75 0 01.75.75v.316a3.78 3.78 0 011.653.713c.426.33.744.74.925 1.2a.75.75 0 01-1.395.55 1.35 1.35 0 00-.447-.563 2.187 2.187 0 00-.736-.363V9.3c.698.093 1.383.32 1.959.696.787.514 1.29 1.27 1.29 2.13 0 .86-.504 1.616-1.29 2.13-.576.377-1.261.603-1.959.696v.299a.75.75 0 11-1.5 0v-.3c-.698-.092-1.383-.318-1.959-.695C8.716 13.741 8.211 12.986 8.211 12.127c0-.86.504-1.616 1.29-2.13A3.78 3.78 0 0110 9.3v-2.39c-.336.046-.671.111-.99.196-.317.085-.61.189-.858.31a1.35 1.35 0 00-.447.563.75.75 0 01-1.395-.55c.18-.46.498-.87.925-1.2a3.78 3.78 0 011.653-.713V5.75A.75.75 0 0110 5z" clip-rule="evenodd" />
                                        </svg>
                                        Secure Payments
                                    </dt>
                                    <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                                        <p class="flex-auto">Get paid safely and on time with our secure payment system.</p>
                                    </dd>
                                </div>
                                <div class="flex flex-col">
                                    <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900">
                                        <svg class="h-5 w-5 flex-none text-primary" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M14.243 5.757a6 6 0 10-.986 9.284 1 1 0 111.087 1.678A8 8 0 1118 10a3 3 0 01-4.8 2.401A4 4 0 1114 10a1 1 0 102 0c0-1.537-.586-3.07-1.757-4.243zM12 10a2 2 0 10-4 0 2 2 0 004 0z" clip-rule="evenodd" />
                                        </svg>
                                        Global Reach
                                    </dt>
                                    <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                                        <p class="flex-auto">Connect with clients from around the world and expand your business globally.</p>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>

                <!-- Stats Section -->
                <div class="bg-white py-24 sm:py-32">
                    <div class="mx-auto max-w-7xl px-6 lg:px-8">
                        <dl class="grid grid-cols-1 gap-x-8 gap-y-16 text-center lg:grid-cols-3">
                            <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                                <dt class="text-base leading-7 text-gray-600">Active freelancers</dt>
                                <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">10k+</dd>
                            </div>
                            <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                                <dt class="text-base leading-7 text-gray-600">Projects completed</dt>
                                <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">50k+</dd>
                            </div>
                            <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                                <dt class="text-base leading-7 text-gray-600">Client satisfaction</dt>
                                <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">98%</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

        @else
            @include('home.client-view')
        @endif
    @else
        @include('home.guest-view')
    @endauth
</x-layouts.app>