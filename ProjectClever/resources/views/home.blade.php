<x-layouts.app>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-700 text-white py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">
                    Find the Perfect Freelancer for Your Project
                </h1>
                <p class="text-xl mb-8">
                    Connect with talented professionals and get your work done
                </p>
                <div class="max-w-xl mx-auto">
                    <form  method="GET" class="flex gap-2">
                        <input type="text"
                               name="search"
                               placeholder="What service are you looking for?"
                               class="w-full px-4 py-3 rounded-lg text-gray-900">
                        <button type="submit"
                                class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-blue-50 transition">
                            Search
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Services -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8">Featured Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="bg-gray-50 py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8">Browse Categories</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            </div>
        </div>
    </section>
</x-app-layout>
