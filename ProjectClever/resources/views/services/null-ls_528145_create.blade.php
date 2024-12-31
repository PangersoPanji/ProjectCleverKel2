<x-layouts.app>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Back Button -->
                    <div class="mb-6">
                        <a href="{{ route('services.manage') }}" 
                           class="text-blue-600 hover:text-blue-700 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to Services
                        </a>
                    </div>

                    <div class="mb-6">
                        <h2 class="text-2xl font-bold">Edit Service</h2>
                        <p class="text-gray-600">Update your service information</p>
                    </div>

                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('services.update', $service) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                Service Title
                            </label>
                            <input type="text" 
                                   name="title" 
                                   id="title"
                                   value="{{ old('title', $service->title) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700">
                                Category
                            </label>
                            <select name="category_id" 
                                    id="category_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $service->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Description
                            </label>
                            <textarea name="description" 
                                      id="description" 
                                      rows="6"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                      required>{{ old('description', $service->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Price and Duration -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">
                                    Price ($)
                                </label>
                                <input type="number" 
                                       name="price" 
                                       id="price"
                                       value="{{ old('price', $service->price) }}"
                                       min="1"
                                       step="0.01"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       required>
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="duration_days" class="block text-sm font-medium text-gray-700">
                                    Delivery Time (days)
                                </label>
                                <input type="number" 
                                       name="duration_days" 
                                       id="duration_days"
                                       value="{{ old('duration_days', $service->duration_days) }}"
                                       min="1"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       required>
                                @error('duration_days')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Thumbnail Image -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Thumbnail Image
                            </label>
                            @if($service->thumbnail)
                                <div class="mt-2 mb-4">
                                    <div class="relative group w-32">
                                        <img src="{{ Storage::url($service->thumbnail) }}" 
                                             alt="Current thumbnail" 
                                             class="w-32 h-32 object-cover rounded-lg">
                                        <button type="button"
                                                onclick="removeThumbnail()"
                                                class="absolute top-0 right-0 p-1 bg-red-500 text-white rounded-full opacity-0 group-hover:opacity-100 transition">
                                            ×
                                        </button>
                                    </div>
                                </div>
                            @endif
                            <input type="file" 
                                   name="thumbnail" 
                                   accept="image/*"
                                   class="mt-1 block w-full text-sm text-gray-500
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-md file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-blue-50 file:text-blue-700
                                          hover:file:bg-blue-100">
                            <input type="hidden" name="remove_thumbnail" id="remove_thumbnail" value="0">
                            @error('thumbnail')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gallery Images -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Gallery Images
                            </label>
                            @if($service->gallery)
                                <div class="mt-2 mb-4 grid grid-cols-4 gap-4">
                                    @foreach($service->gallery as $index => $image)
                                        <div class="relative group">
                                            <img src="{{ Storage::url($image) }}" 
                                                 alt="Gallery image" 
                                                 class="w-full h-32 object-cover rounded-lg">
                                            <button type="button"
                                                    onclick="removeGalleryImage(this, {{ $index }})"
                                                    class="absolute top-0 right-0 p-1 bg-red-500 text-white rounded-full opacity-0 group-hover:opacity-100 transition">
                                                ×
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <input type="file" 
                                   name="gallery[]" 
                                   multiple 
                                   accept="image/*"
                                   class="mt-1 block w-full text-sm text-gray-500
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-md file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-blue-50 file:text-blue-700
                                          hover:file:bg-blue-100">
                            <input type="hidden" name="removed_gallery_images" id="removed_gallery_images" value="">
                            @error('gallery')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">
                                You can select multiple images for the gallery
                            </p>
                        </div>

                        <!-- Active Status -->
                        <div>
                            <label class="inline-flex items-center">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" 
                                       name="is_active" 
                                       value="1"
                                       {{ old('is_active', $service->is_active) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <span class="ml-2">Active</span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" 
                                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                                Update Service
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        let removedGalleryImages = [];

        function removeThumbnail() {
            const container = document.querySelector('img[alt="Current thumbnail"]').parentElement;
            container.style.display = 'none';
            document.getElementById('remove_thumbnail').value = '1';
        }

        function removeGalleryImage(button, index) {
            const imageContainer = button.parentElement;
            imageContainer.remove();
            removedGalleryImages.push(index);
            document.getElementById('removed_gallery_images').value = JSON.stringify(removedGalleryImages);
        }
    </script>
    @endpush
</x-layouts.app>