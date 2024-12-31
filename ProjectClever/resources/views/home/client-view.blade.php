<!-- Hero Section -->
<section class="bg-primary text-white py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">
                Welcome Back, {{ auth()->user()->name }}!
            </h1>
            <p class="text-xl mb-8">
                Find the perfect freelancer for your next project
            </p>
        </div>
    </div>
</section>

<!-- Featured Services -->
@if($featuredServices->isNotEmpty())
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8">Featured Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($featuredServices as $service)
                    <a href="{{ route('services.show', $service) }}"
                       class="bg-white rounded-lg shadow-sm hover:shadow-md transition">
                        <div class="p-4">
                            <p class="text-sm text-primary mb-2">
                                {{ $service->category->name }}
                            </p>
                            <h3 class="font-semibold mb-2">{{ $service->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4">
                                {{ Str::limit($service->description, 100) }}
                            </p>
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold">
                                    ${{ number_format($service->price, 2) }}
                                </span>
                                <div class="text-sm text-gray-500 flex items-center gap-2">
                                    <span>by {{ $service->user->name }}</span>
                                    @if($service->user->ratings_average)
                                        <span class="flex items-center text-yellow-500">
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                            </svg>
                                            {{ number_format($service->user->ratings_average, 1) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <a href="{{ route('services.index') }}" class="text-primary font-semibold hover:text-blue-700">
                    View All Services →
                </a>
            </div>
        </div>
    </section>
@endif

<!-- Categories -->
<section class="bg-gray-50 py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8">Browse Categories</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($categories as $category)
                <a href="{{ route('services.category', $category) }}"
                   class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition text-center group">
                    <h3 class="font-semibold mb-2 group-hover:text-primary">
                        {{ $category->name }}
                    </h3>
                    <p class="text-sm text-gray-500">
                        {{ $category->services_count }} services
                    </p>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-12 text-center">How It Works</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-blue-600 text-xl font-bold">1</span>
                </div>
                <h3 class="font-semibold mb-2">Browse Services</h3>
                <p class="text-gray-600">Find the perfect service for your needs</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-blue-600 text-xl font-bold">2</span>
                </div>
                <h3 class="font-semibold mb-2">Contact Freelancer</h3>
                <p class="text-gray-600">Discuss your project details</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-blue-600 text-xl font-bold">3</span>
                </div>
                <h3 class="font-semibold mb-2">Get It Done</h3>
                <p class="text-gray-600">Receive your completed work</p>
            </div>
        </div>
    </div>
</section>

<!-- Popular Freelancers -->
<section class="bg-white py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8">Top Rated Freelancers</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($topFreelancers ?? [] as $freelancer)
                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition p-6 text-center">
                    <div class="w-20 h-20 mx-auto mb-4">
                        <img src="{{ $freelancer->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($freelancer->name) }}"
                             alt="{{ $freelancer->name }}"
                             class="w-full h-full rounded-full object-cover">
                    </div>
                    <h3 class="font-semibold mb-1">{{ $freelancer->name }}</h3>
                    <p class="text-sm text-gray-500 mb-2">{{ $freelancer->title }}</p>
                    @if($freelancer->ratings_average)
                        <div class="flex items-center justify-center text-yellow-500 mb-2">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                            </svg>
                            <span class="ml-1">{{ number_format($freelancer->ratings_average, 1) }}</span>
                        </div>
                    @endif
                    <a href="{{ route('services.index', ['freelancer' => $freelancer->id]) }}"
                       class="text-primary hover:text-blue-700 text-sm">
                        View Services
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-primary text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Need Something Done?</h2>
        <p class="text-xl mb-8">Browse thousands of services from our talented freelancers</p>
        <a href="{{ route('services.index') }}"
           class="bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition inline-block">
            Explore All Services
        </a>
    </div>
</section>