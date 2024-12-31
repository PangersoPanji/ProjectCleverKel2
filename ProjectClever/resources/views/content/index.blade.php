<x-layouts.app>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-3xl font-bold mb-8 text-center">Help Center</h2>

                    <!-- FAQs Section -->
                    <div class="mb-12">
                        <h3 class="text-2xl font-semibold mb-6">Frequently Asked Questions</h3>
                        <div class="space-y-4">
                            @forelse($content['faqs'] as $faq)
                                <div x-data="{ open: false }" class="border rounded-lg">
                                    <button @click="open = !open"
                                            class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50">
                                        <h4 class="text-lg font-medium">{{ $faq->title }}</h4>
                                        <svg class="w-5 h-5 transform transition-transform"
                                             :class="{ 'rotate-180': open }"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                    <div x-show="open"
                                         x-collapse
                                         class="px-6 pb-4 prose max-w-none">
                                        {!! $faq->content !!}
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500">No FAQs available.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Guides Section -->
                    @if($content['guides']->isNotEmpty())
                        <div class="mb-12">
                            <h3 class="text-2xl font-semibold mb-6">User Guides</h3>
                            <div class="space-y-6">
                                @foreach($content['guides'] as $guide)
                                    <article class="prose max-w-none">
                                        <h4 class="text-xl font-medium mb-4">{{ $guide->title }}</h4>
                                        <div class="bg-gray-50 rounded-lg p-6">
                                            {!! $guide->content !!}
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Policies Section -->
                    @if($content['policies']->isNotEmpty())
                        <div class="mb-12">
                            <h3 class="text-2xl font-semibold mb-6">Policies & Terms</h3>
                            <div class="space-y-6">
                                @foreach($content['policies'] as $policy)
                                    <article class="prose max-w-none">
                                        <h4 class="text-xl font-medium mb-4">{{ $policy->title }}</h4>
                                        <div class="bg-gray-50 rounded-lg p-6">
                                            {!! $policy->content !!}
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
