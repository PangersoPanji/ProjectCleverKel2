<x-layouts.app>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-3xl font-bold mb-8 text-center">Frequently Asked Questions</h2>

                    <div class="max-w-3xl mx-auto space-y-6">
                        @forelse($faqs as $faq)
                            <div x-data="{ open: false }" class="border rounded-lg">
                                <button @click="open = !open" 
                                        class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50">
                                    <h3 class="text-lg font-medium">{{ $faq->title }}</h3>
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
                                     class="px-6 pb-4">
                                    <div class="prose max-w-none">
                                        {!! $faq->content !!}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-500">No FAQs available at the moment.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
