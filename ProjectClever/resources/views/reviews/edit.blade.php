<x-layouts.app>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold">Edit Review</h2>
                        <p class="text-gray-600">Update your review for {{ $review->project->service->title }}</p>
                    </div>

                    <form action="{{ route('reviews.update', $review) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <!-- Rating -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Rating
                            </label>
                            <div class="flex gap-2" x-data="{ rating: {{ $review->rating }} }">
                                @for($i = 1; $i <= 5; $i++)
                                    <label class="cursor-pointer">
                                        <input type="radio"
                                               name="rating"
                                               value="{{ $i }}"
                                               class="hidden peer"
                                               x-on:click="rating = {{ $i }}"
                                               {{ old('rating', $review->rating) == $i ? 'checked' : '' }}
                                               required>
                                        <svg class="w-8 h-8"
                                             x-bind:class="rating >= {{ $i }} ? 'text-yellow-400' : 'text-gray-300'"
                                             fill="currentColor"
                                             viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    </label>
                                @endfor
                            </div>
                            @error('rating')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Review Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                Review Title (Optional)
                            </label>
                            <input type="text"
                                   id="title"
                                   name="title"
                                   value="{{ old('title', $review->title) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Review Comment -->
                        <div>
                            <label for="comment" class="block text-sm font-medium text-gray-700">
                                Your Review
                            </label>
                            <textarea id="comment"
                                     name="comment"
                                     rows="4"
                                     required
                                     class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('comment', $review->comment) }}</textarea>
                            @error('comment')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Public/Private Toggle -->
                        <div class="flex items-center">
                            <input type="checkbox"
                                   id="is_public"
                                   name="is_public"
                                   value="1"
                                   {{ old('is_public', $review->is_public) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <label for="is_public" class="ml-2 block text-sm text-gray-700">
                                Make this review public
                            </label>
                        </div>

                        <div class="flex justify-end gap-4">
                            <a href="{{ route('orders.show', $review->project) }}"
                               class="text-gray-600 hover:text-gray-900">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                Update Review
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
