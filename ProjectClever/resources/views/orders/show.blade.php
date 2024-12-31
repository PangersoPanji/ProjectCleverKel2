<x-layouts.app>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Back Button -->
                    <div class="mb-6">
                        <a href="{{ Auth::id() === $project->client_id ? route('orders.index') : route('orders.freelancer') }}"
                           class="text-blue-600 hover:text-blue-700 flex items-center gap-2">
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
                            <x-image-preview
                                :src="$project->transaction_proof"
                                alt="Transaction Proof"
                                class="max-w-md"
                            />
                        </div>
                    </div>

                    <!-- Freelancer Actions (only visible to freelancer) -->
                    @if(Auth::id() === $project->freelancer_id && $project->status !== 'completed' && $project->status !== 'cancelled')
                        <div class="border-t pt-6">
                            <h3 class="text-lg font-semibold mb-4">Actions</h3>
                            <form action="{{ route('orders.update-status', $project) }}" method="POST" class="flex gap-4">
                                @csrf
                                @method('PATCH')

                                @if($project->status === 'pending')
                                    <button type="submit"
                                            name="status"
                                            value="in_progress"
                                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                        Start Project
                                    </button>
                                @endif

                                @if($project->status === 'in_progress')
                                    <button type="submit"
                                            name="status"
                                            value="completed"
                                            class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                                        Mark as Completed
                                    </button>
                                @endif

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
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>