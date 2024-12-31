<x-layouts.app>
    <div class="bg-gray-100 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Search & Filter Section -->
            <div class="mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <form method="GET" action="{{ route('services.index') }}" class="space-y-4">
                        <!-- Search Bar -->
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                                Search Services
                            </label>
                            <input type="text"
                                   name="search"
                                   id="search"
                                   value="{{ request('search') }}"
                                   placeholder="What service are you looking for?"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Categories -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Categories
                            </label>
                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('services.index') }}"
                                   class="inline-flex items-center px-3 py-1 rounded-full text-sm
                                        {{ !request('category') ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }}">
                                    All
                                </a>
                                @foreach($categories as $category)
                                    <a href="{{ route('services.index', ['category' => $category->id] + request()->except('page')) }}"
                                       class="inline-flex items-center px-3 py-1 rounded-full text-sm
                                            {{ request('category') == $category->id ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }}">
                                        {{ $category->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Results Count -->
            <div class="mb-6 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-900">
                    {{ request('search') ? 'Search Results' : 'All Services' }}
                    <span class="text-gray-500 font-normal">({{ $services->total() }} services)</span>
                </h2>
            </div>

            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($services as $service)
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition">
                        @if($service->thumbnail)
                            <img src="{{ Storage::url($service->thumbnail) }}"
                                 alt="{{ $service->title }}"
                                 class="w-full h-48 object-cover rounded-t-lg">
                        @endif
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-primary">{{ $service->category->name }}</span>
                                <span class="text-sm text-gray-500">{{ $service->duration_days }} days</span>
                            </div>

                            <h3 class="text-lg font-semibold mb-2">
                                <a href="{{ route('services.show', $service) }}" class="hover:text-primary">
                                    {{ $service->title }}
                                </a>
                            </h3>

                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ $service->description }}
                            </p>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                        <span class="text-sm font-medium text-gray-600">
                                            {{ substr($service->user->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <span class="text-sm text-gray-600">{{ $service->user->name }}</span>
                                </div>
                                <span class="text-lg font-bold text-primary">${{ number_format($service->price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 mb-4">No services found.</p>
                        <a href="{{ route('services.index') }}" class="text-primary hover:text-blue-700">
                            Clear filters
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $services->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-layouts.app>
