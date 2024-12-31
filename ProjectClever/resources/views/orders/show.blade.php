<x-layouts.app>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Back Button -->
                    <div class="mb-6">
                        <a href="{{ Auth::id() === $project->client_id ? route('orders.index') : route('orders.freelancer') }}"
                           class="text-primary hover:text-blue-700 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to Orders
                        </a>
                    </div>

                    <!-- Order Header -->
                    <div class="mb-8">
                        <div class="flex justify-between items-start">
                            <div>
                                <h2 class="text-2xl font-bold mb-2">Order #{{ $project->id }}</h2>
                                <p class="text-gray-600">
                                    Placed on {{ $project->created_at->format('M d, Y') }}
                                </p>
                            </div>
                            <span class="px-4 py-2 rounded-full text-sm font-semibold
                                @if($project->status === 'completed') bg-green-100 text-green-800
                                @elseif($project->status === 'in_progress') bg-blue-100 text-blue-800
                                @elseif($project->status === 'cancelled') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800
                                @endif">
                                {{ ucfirst($project->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Service Details -->
                    <div class="bg-gray-50 rounded-lg p-6 mb-8">
                        <h3 class="text-lg font-semibold mb-4">Service Details</h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-medium text-gray-500 mb-2">Service</h4>
                                <p class="text-gray-900">{{ $project->service->title }}</p>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-500 mb-2">Amount</h4>
                                <p class="text-gray-900">${{ number_format($project->amount, 2) }}</p>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-500 mb-2">Delivery Time</h4>
                                <p class="text-gray-900">{{ $project->service->duration_days }} days</p>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-500 mb-2">Due Date</h4>
                                <p class="text-gray-900">{{ $project->end_date->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Project Requirements -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4">Project Requirements</h3>
                        <div class="bg-white border rounded-lg p-6">
                            <p class="text-gray-700 whitespace-pre-line">{{ $project->requirements }}</p>
                        </div>
                    </div>

                    <!-- Transaction Proof -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4">Transaction Proof</h3>
                        <div class="bg-white border rounded-lg p-6">
                            @if($project->transaction_proof)
                                <img src="{{ Storage::url($project->transaction_proof) }}"
                                     alt="Transaction Proof"
                                     class="max-w-md rounded-lg shadow-sm">
                            @else
                                <p class="text-gray-500">No transaction proof available</p>
                            @endif
                        </div>
                    </div>

                    <!-- Freelancer Actions (only visible to freelancer) -->
                    @if(Auth::id() === $project->freelancer_id && $project->status !== 'completed' && $project->status !== 'cancelled')
                        <div class="border-t pt-6">
                            <h3 class="text-lg font-semibold mb-4">Actions</h3>

                            @if($project->status === 'pending')
                                <form action="{{ route('orders.update-status', $project) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            name="status"
                                            value="in_progress"
                                            class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                        Start Project
                                    </button>
                                </form>
                            @endif

                            @if($project->status === 'in_progress')
                                <form action="{{ route('orders.update-status', $project) }}"
                                      method="POST"
                                      enctype="multipart/form-data"
                                      class="space-y-4">
                                    @csrf
                                    @method('PATCH')

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Upload Completion Proof
                                        </label>
                                        <input type="file"
                                               name="completion_proof"
                                               required
                                               accept="image/*"
                                               class="block w-full text-sm text-gray-500
                                                      file:mr-4 file:py-2 file:px-4
                                                      file:rounded-md file:border-0
                                                      file:text-sm file:font-semibold
                                                      file:bg-blue-50 file:text-blue-700
                                                      hover:file:bg-blue-100">
                                        @error('completion_proof')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="flex gap-4">
                                        <button type="submit"
                                                name="status"
                                                value="completed"
                                                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                                            Mark as Completed
                                        </button>
                                    </div>
                                </form>
                            @endif

                            <!-- Cancel button -->
                            <form action="{{ route('orders.update-status', $project) }}" method="POST" class="mt-4">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        name="status"
                                        value="cancelled"
                                        class="text-red-600 hover:text-red-700"
                                        onclick="return confirm('Are you sure you want to cancel this project?')">
                                    Cancel Project
                                </button>
                            </form>
                        </div>
                    @endif

                    <!-- Show completion proof if available -->
                    @if($project->completion_proof)
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold mb-4">Project Completion Proof</h3>
                            <div class="bg-white border rounded-lg p-6">
                                <img src="{{ Storage::url($project->completion_proof) }}"
                                     alt="Completion Proof"
                                     class="max-w-md rounded-lg shadow-sm mb-4">
                                <a href="{{ Storage::url($project->completion_proof) }}"
                                   download
                                   class="inline-flex items-center text-primary hover:text-blue-700">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                    Download Completion Proof
                                </a>
                            </div>
                        </div>
                    @endif

                    <!-- Contact Information -->
                    <div class="grid md:grid-cols-2 gap-6 mt-8 bg-gray-50 rounded-lg p-6">
                        <div>
                            <h3 class="font-semibold mb-4">Client</h3>
                            <p class="text-gray-700">{{ $project->client->name }}</p>
                            <!-- Add more client details if needed -->
                        </div>
                        <div>
                            <h3 class="font-semibold mb-4">Freelancer</h3>
                            <p class="text-gray-700">{{ $project->freelancer->name }}</p>
                            <!-- Add more freelancer details if needed -->
                        </div>
                    </div>
                    <!-- Review Section (Only visible to client for completed projects) -->
                    @if(Auth::id() === $project->client_id && $project->status === 'completed' && !$project->review)
                        <div class="mt-8 border-t pt-6">
                            <h3 class="text-lg font-semibold mb-4">Leave a Review</h3>
                            <form action="{{ route('reviews.store', $project) }}" method="POST" class="space-y-4">
                                @csrf

                                <!-- Rating -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Rating
                                    </label>
                                    <div class="flex gap-2" x-data="{ rating: 0 }">
                                        @for($i = 1; $i <= 5; $i++)
                                            <label class="cursor-pointer">
                                                <input type="radio"
                                                       name="rating"
                                                       value="{{ $i }}"
                                                       class="hidden peer"
                                                       x-on:click="rating = {{ $i }}"
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
                                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
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
                                           checked
                                           class="rounded border-gray-300 text-primary shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <label for="is_public" class="ml-2 block text-sm text-gray-700">
                                        Make this review public
                                    </label>
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit"
                                            class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                        Submit Review
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif

                    <!-- Display Review if exists -->
                    @if($project->review)
                        <div class="mt-8 border-t pt-6">
                            <h3 class="text-lg font-semibold mb-4">Review</h3>
                            @if(Auth::id() === $project->review->client_id)
                            <div class="flex items-center gap-4">
                                <a href="{{ route('reviews.edit', $project->review) }}"
                                   class="text-primary hover:text-blue-700">
                                    Edit Review
                                </a>
                                <form action="{{ route('reviews.destroy', $project->review) }}"
                                      method="POST"
                                      class="inline"
                                      onsubmit="return confirm('Are you sure you want to delete this review?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700">
                                        Delete Review
                                    </button>
                                </form>
                            </div>
                        @endif
                            <div class="bg-gray-50 rounded-lg p-6">
                                <div class="flex items-center gap-2 mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= $project->review->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                             fill="currentColor"
                                             viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>
                                @if($project->review->title)
                                    <h4 class="font-semibold mb-2">{{ $project->review->title }}</h4>
                                @endif
                                <p class="text-gray-700">{{ $project->review->comment }}</p>
                                <div class="mt-4 text-sm text-gray-500">
                                    By {{ $project->review->client->name }} on {{ $project->review->created_at->format('M d, Y') }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
