<x-layouts.app>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                <div class="mb-6">
                    <svg class="w-16 h-16 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold mb-4">Order Placed Successfully!</h2>
                <p class="text-gray-600 mb-6">
                    Your order has been placed and is awaiting freelancer confirmation.
                </p>
                <div class="flex justify-center gap-4">
                    <a href="{{ route('orders.index') }}"
                       class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                        View My Orders
                    </a>
                    <a href="{{ route('services.index') }}"
                       class="text-blue-600 hover:text-blue-700">
                        Browse More Services
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
