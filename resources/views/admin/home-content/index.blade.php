<x-admin-layout :title="'Manage Home Content'">

    <div class="space-y-8">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-teal-600 via-cyan-600 to-blue-700 rounded-2xl p-8 text-white shadow-2xl relative overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
            
            <div class="relative z-10">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mr-4 backdrop-blur-sm">
                        <i class="fas fa-home text-2xl text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold">Home Content Management</h1>
                        <p class="text-teal-100 mt-1">Edit sections displayed on the main page</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition 
                 class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-lg p-4 shadow-lg">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <p class="text-green-800 font-semibold">{{ session('success') }}</p>
                    </div>
                    <button @click="show = false" class="text-green-400 hover:text-green-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        <!-- Content Sections Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($sections as $key => $label)
                @php
                    $content = $contents->get($key);
                    $isActive = $content ? $content->is_active : false;
                @endphp
                
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-200 overflow-hidden transform hover:-translate-y-1">
                    <!-- Card Header -->
                    <div class="bg-gradient-to-r from-teal-500 to-cyan-500 p-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-white">{{ $label }}</h3>
                            @if($content)
                                <form action="{{ route('admin.home-content.toggle', $key) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-3 py-1 rounded-full text-xs font-semibold transition-colors {{ $isActive ? 'bg-green-400 text-green-900' : 'bg-red-400 text-red-900' }}">
                                        {{ $isActive ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            @else
                                <span class="px-3 py-1 bg-gray-400 text-gray-900 rounded-full text-xs font-semibold">Not Set</span>
                            @endif
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6">
                        @if($content)
                            <div class="space-y-3 mb-4">
                                @if($content->title)
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide">Title</p>
                                        <p class="text-gray-900 font-semibold">{{ Str::limit($content->title, 50) }}</p>
                                    </div>
                                @endif
                                
                                @if($content->subtitle)
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide">Subtitle</p>
                                        <p class="text-gray-600">{{ Str::limit($content->subtitle, 60) }}</p>
                                    </div>
                                @endif
                                
                                @if($content->image)
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide mb-2">Image</p>
                                        <img src="{{ asset('storage/' . $content->image) }}" alt="Preview" class="w-full h-32 object-cover rounded-lg">
                                    </div>
                                @endif

                                <div class="pt-2 border-t border-gray-200">
                                    <p class="text-xs text-gray-500">Last updated: {{ $content->updated_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @else
                            <p class="text-gray-500 italic mb-4">This section has not been configured yet.</p>
                        @endif

                        <!-- Actions -->
                        <a href="{{ route('admin.home-content.edit', $key) }}" 
                           class="block w-full bg-gradient-to-r from-teal-600 to-cyan-600 hover:from-teal-700 hover:to-cyan-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 text-center transform hover:scale-105">
                            <i class="fas fa-edit mr-2"></i>{{ $content ? 'Edit Section' : 'Configure Section' }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Info Card -->
        <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-6">
            <div class="flex items-start">
                <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                    <i class="fas fa-info-circle text-white"></i>
                </div>
                <div>
                    <h4 class="text-lg font-bold text-blue-900 mb-2">How it works</h4>
                    <p class="text-blue-800">
                        Each section controls specific content on your homepage. Click "Edit Section" to customize titles, images, and other content. 
                        Toggle the status to show or hide sections from the public homepage.
                    </p>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>