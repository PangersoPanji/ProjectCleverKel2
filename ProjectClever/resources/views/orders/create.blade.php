<x-layouts.app>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold mb-4">Order Service</h2>
                        <div class="bg-gray-50 p-4 rounded-lg mb-6">
                            <h3 class="font-semibold mb-2">{{ $service->title }}</h3>
                            <p class="text-gray-600 mb-2">{{ $service->description }}</p>
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-xl">${{ number_format($service->price, 2) }}</span>
                                <span class="text-gray-600">Delivery: {{ $service->duration_days }} days</span>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('orders.store', $service) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Requirements -->
                        <div class="mb-6">
                            <label for="requirements" class="block text-sm font-medium text-gray-700 mb-2">
                                Project Requirements
                            </label>
                            <textarea
                                id="requirements"
                                name="requirements"
                                rows="4"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Describe your project requirements in detail..."
                                required
                            >{{ old('requirements') }}</textarea>
                            @error('requirements')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Transaction Proof -->
                        <div class="mb-6">
                            <label for="transaction_proof" class="block text-sm font-medium text-gray-700 mb-2">
                                Upload Transaction Proof
                            </label>
                            <input
                                type="file"
                                id="transaction_proof"
                                name="transaction_proof"
                                accept="image/*"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                onchange="previewImage(this)"
                                required
                            >
                            <div class="mt-4">
                                <img id="image-preview" src="#" alt="Preview" class="hidden max-w-md rounded-lg shadow-sm">
                            </div>
                            @error('transaction_proof')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                                Place Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

@push('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const preview = document.getElementById('image-preview');
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush