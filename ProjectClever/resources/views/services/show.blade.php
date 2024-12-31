<x-layouts.app>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Back Button -->
                    <div class="mb-6">
                        <a href="{{ url()->previous() }}"
                           class="text-primary hover:text-blue-700 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back
                        </a>
                    </div>

                    <!-- Service Details -->
                    <div class="max-w-3xl mx-auto">
                        <!-- Thumbnail -->
                        @if($service->thumbnail)
                            <div class="mb-6">
                                <img src="{{ Storage::url($service->thumbnail) }}"
                                     alt="{{ $service->title }}"
                                     class="w-full h-64 object-cover rounded-lg">
                            </div>
                        @endif

                        <!-- Title and Basic Info -->
                        <div class="mb-6">
                            <h1 class="text-3xl font-bold mb-4">{{ $service->title }}</h1>
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-4">
                                    <span class="text-gray-600">
                                        Category: {{ $service->category->name }}
                                    </span>
                                    <span class="text-gray-600">
                                        By: {{ $service->user->name }}
                                    </span>
                                </div>
                                <span class="text-2xl font-bold text-primary">
                                    ${{ number_format($service->price, 2) }}
                                </span>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="prose max-w-none mb-8">
                            {{ $service->description }}
                        </div>

                        <!-- Service Details -->
                        <div class="bg-gray-50 rounded-lg p-4 mb-8">
                            <h3 class="font-semibold mb-2">Service Details</h3>
                            <ul class="space-y-2">
                                <li class="flex items-center gap-2">
                                    <span class="text-gray-600">Delivery Time:</span>
                                    <span>{{ $service->duration_days }} days</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="text-gray-600">Status:</span>
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $service->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $service->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </li>
                            </ul>
                        </div>

                        <!-- Gallery -->
                        @if($service->gallery && count($service->gallery) > 0)
                            <div class="mb-8">
                                <h3 class="font-semibold mb-4">Gallery</h3>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                    @foreach($service->gallery as $image)
                                        <img src="{{ Storage::url($image) }}"
                                             alt="Gallery image"
                                             class="w-full h-48 object-cover rounded-lg">
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <!-- Order Section -->
                        @auth
                            @if(auth()->user()->role === 'client' && $service->is_active)
                                <div class="mt-8 p-6 bg-blue-50 rounded-lg">
                                    <h3 class="text-xl font-semibold mb-4">Interested in this service?</h3>
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-gray-600 mb-2">
                                                Get it delivered in {{ $service->duration_days }} days
                                            </p>
                                            <p class="text-2xl font-bold text-primary">
                                                ${{ number_format($service->price, 2) }}
                                            </p>
                                        </div>
                                        <a href="{{ route('orders.create', $service) }}"
                                           class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                                            Order Now
                                        </a>
                                    </div>
                                </div>
                            @elseif(auth()->user()->role === 'freelancer' && $service->user_id === auth()->id())
                                <div class="mt-8 p-6 bg-gray-50 rounded-lg">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-xl font-semibold">Manage this service</h3>
                                        <div class="space-x-4">
                                            <a href="{{ route('services.edit', $service) }}"
                                               class="text-primary hover:text-blue-700">
                                                Edit Service
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="mt-8 p-6 bg-gray-50 rounded-lg text-center">
                                <p class="text-gray-600 mb-4">
                                    Want to order this service?
                                </p>
                                <a href="{{ route('login') }}"
                                   class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-blue-700 inline-block">
                                    Login to Order
                                </a>
                            </div>
                        @endauth

                        <!-- Freelancer Info -->
                        <div class="mt-8 p-6 bg-gray-50 rounded-lg">
                            <h3 class="font-semibold mb-4">About the Freelancer</h3>
                            <div class="flex items-center gap-4">
                                <div class="flex-shrink-0">
                                    <!-- You can add user avatar here if you have one -->
                                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                        <span class="text-primary font-semibold">
                                            {{ substr($service->user->name, 0, 1) }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="font-semibold">{{ $service->user->name }}</h4>
                                    <p class="text-gray-600 text-sm">
                                        Member since {{ $service->user->created_at->format('M Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>