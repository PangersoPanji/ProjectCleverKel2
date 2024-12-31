<x-layouts.app>
    <div class="bg-gray-100 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Category Header -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <div class="max-w-3xl">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $category->name }}</h1>
                    @if($category->description)
                        <p class="text-gray-600">{{ $category->description }}</p>
                    @endif
                    <div class="mt-4 text-sm text-gray-500">
                        {{ $services->total() }} services available
                    </div>
                </div>
            </div>

            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($services as $service)
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition">
                        @if($service->thumbnail)
                            <img src="{{ Storage::url($service->thumbnail) }}"
                                 alt="{{ $service->title }}"
                                 class="w-full h-48 object-cover rounded-t-lg"
                                 onerror="this.src='/images/placeholder.jpg'">
                        @else
                            <div class="w-full h-48 bg-gray-100 rounded-t-lg flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="p-4">
                            <h3 class="text-lg font-semibold mb-2">
                                <a href="{{ route('services.show', $service) }}" class="hover:text-primary">
                                    {{ $service->title }}
                                </a>
                            </h3>

                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ $service->description }}
                            </p>

                            <div class="flex items-center justify-between mt-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                        <span class="text-sm font-medium text-gray-600">
                                            {{ substr($service->user->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <span class="text-sm text-gray-600">{{ $service->user->name }}</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-lg font-bold text-primary">
                                        ${{ number_format($service->price, 2) }}
                                    </span>
                                    <div class="text-sm text-gray-500">
                                        {{ $service->duration_days }} days delivery
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 mb-4">No services found in this category.</p>
                        <a href="{{ route('services.index') }}" class="text-primary hover:text-blue-700">
                            Browse all services
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $services->links() }}
            </div>
        </div>
    </div>
</x-layouts.app>
