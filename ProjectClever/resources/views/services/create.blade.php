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
                        <h2 class="text-2xl font-bold">Create New Service</h2>
                        <p class="text-gray-600">Add a new service to your portfolio</p>
                    </div>

                    <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                Service Title
                            </label>
                            <input type="text"
                                   name="title"
                                   id="title"
                                   value="{{ old('title') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category Selection -->
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <label for="category_id" class="block text-sm font-medium text-gray-700">
                                    Category
                                </label>
                                <button type="button"
                                        onclick="openCategoryModal()"
                                        class="text-sm text-blue-600 hover:text-blue-700">
                                    + Add New Category
                                </button>
                            </div>
                            <select name="category_id"
                                    id="category_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    required>
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                      required>{{ old('description') }}</textarea>
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
                                       value="{{ old('price') }}"
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
                                       value="{{ old('duration_days') }}"
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
                            <input type="file"
                                   name="thumbnail"
                                   accept="image/*"
                                   class="mt-1 block w-full text-sm text-gray-500
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-md file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-blue-50 file:text-blue-700
                                          hover:file:bg-blue-100"
                                   required>
                            @error('thumbnail')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <div id="thumbnail-preview" class="mt-2 hidden">
                                <img src="" alt="Thumbnail preview" class="w-32 h-32 object-cover rounded-lg">
                            </div>
                        </div>

                        <!-- Gallery Images -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Gallery Images
                            </label>
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
                            @error('gallery')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">
                                You can select multiple images for the gallery (optional)
                            </p>
                            <div id="gallery-preview" class="mt-2 grid grid-cols-4 gap-4">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit"
                                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                                Create Service
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Category Modal (Outside the main form) -->
    <div id="categoryModal"
         class="fixed inset-0 bg-gray-500 bg-opacity-75 hidden"
         style="z-index: 50;">
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Add New Category</h3>
                        <button type="button" onclick="closeCategoryModal()" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form id="categoryForm" class="space-y-4">
                        <div>
                            <label for="categoryName" class="block text-sm font-medium text-gray-700">
                                Category Name
                            </label>
                            <input type="text"
                                   id="categoryName"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   required>
                        </div>

                        <div>
                            <label for="categoryDescription" class="block text-sm font-medium text-gray-700">
                                Description
                            </label>
                            <textarea id="categoryDescription"
                                      rows="3"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                        </div>

                        <div class="flex justify-end gap-2">
                            <button type="button"
                                    onclick="closeCategoryModal()"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-500">
                                Cancel
                            </button>
                            <button type="button"
                                    onclick="submitCategory()"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                Create Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
            // Make functions globally available
            window.openCategoryModal = function() {
                document.getElementById('categoryModal').classList.remove('hidden');
            }

            window.closeCategoryModal = function() {
                document.getElementById('categoryModal').classList.add('hidden');
                document.getElementById('categoryForm').reset();
            }

            window.submitCategory = async function() {
                const name = document.getElementById('categoryName').value;
                const description = document.getElementById('categoryDescription').value;

                if (!name) {
                    alert('Category name is required');
                    return;
                }

                try {
                    const response = await fetch('/api/categories', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ name, description })
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.message || 'Failed to create category');
                    }

                    // Add new category to select dropdown
                    const select = document.getElementById('category_id');
                    const option = new Option(data.name, data.id, true, true);
                    select.add(option);

                    // Close modal and reset form
                    closeCategoryModal();

                } catch (error) {
                    alert(error.message || 'Failed to create category. Please try again.');
                    console.error('Error:', error);
                }
            }

            // Initialize everything when DOM is loaded
            document.addEventListener('DOMContentLoaded', function() {
                // Thumbnail preview
                document.querySelector('input[name="thumbnail"]').addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const preview = document.getElementById('thumbnail-preview');
                            preview.querySelector('img').src = e.target.result;
                            preview.classList.remove('hidden');
                        }
                        reader.readAsDataURL(file);
                    }
                });

                // Gallery preview
                document.querySelector('input[name="gallery[]"]').addEventListener('change', function(e) {
                    const previewContainer = document.getElementById('gallery-preview');
                    previewContainer.innerHTML = '';

                    [...e.target.files].forEach(file => {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const div = document.createElement('div');
                            div.className = 'relative';
                            div.innerHTML = `
                                <img src="${e.target.result}" alt="Gallery preview" class="w-full h-32 object-cover rounded-lg">
                            `;
                            previewContainer.appendChild(div);
                        }
                        reader.readAsDataURL(file);
                    });
                });

                // Modal event listeners
                const modal = document.getElementById('categoryModal');
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        closeCategoryModal();
                    }
                });

                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        closeCategoryModal();
                    }
                });
            });
        </script>
</x-layouts.app>