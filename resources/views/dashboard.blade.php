<x-app-layout>

    <div class="bg-white max-w-7xl mx-auto border-2 rounded-md mt-6 p-6">
        <div class="mb-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h1 class="text-5xl text-gray-900">
                    All Posts
                </h1>
            </div>
        </div>
        <hr class="max-w-7xl mx-auto border-2">
    </div>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form class="w-full mx-auto">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only ">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="default-search"
                        class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Search..." name="search" required value="{{ request('search') }}" />
                    <button type="submit"
                        class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
                </div>
            </form>
        </div>
    </div>

    @if ($articles->isEmpty())
        <h1 class="text-center text-2xl">Artikel tidak ditemukan</h1>
    @else
        @foreach ($articles as $article)
            <div class="py-4">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg flex flex-row px-4 py-6 gap-4">
                        <div class="flex flex-col">
                            <h1 class="text-xl uppercase">{{ \Carbon\Carbon::parse($article->created_at)->format('M') }}
                            </h1>
                            <hr class="w-3/4 border-2 rounded-full">
                            <h1 class="text-5xl">{{ \Carbon\Carbon::parse($article->created_at)->format('d') }}</h1>
                        </div>
                        <div>
                            <div class="w-72 h-52">
                                @if ($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" alt=""
                                        class="w-full h-full object-cover rounded-md">
                                @else
                                    <img src="{{ asset('img/UB.jpg') }}" alt=""
                                        class="w-full h-full object-cover rounded-md">
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-col flex-1">
                            <h1 class="text-4xl">{{ $article->title }}</h1>
                            <p class="text-gray-500 mb-2">Written by {{ $article->user->name }}
                                {{ $article->created_at->diffForHumans() }}</p>
                            <p class="flex-1 line-clamp-5">{{ $article->excerpt }}</p>
                            <ul class="flex flex-wrap items-center gap-2">
                                <a href="{{ route('category.show', $article->category->slug) }}">
                                    <li class="uppercase underline">{{ $article->category->name }}</li>
                                </a>
                                @foreach ($article->tags->take(3) as $tag)
                                    @if ($loop->first)
                                        <li class="">-</li>
                                    @endif
                                    <a href="{{ route('tags.show', $tag->slug) }}">
                                        <li class="bg-gray-200 px-1 py-0.5 rounded-md">{{ $tag->name }}</li>
                                    </a>
                                @endforeach
                                @if ($article->tags->count() > 3)
                                    <li class="bg-gray-200 px-1 py-0.5 rounded-md">...</li>
                                @endif
                            </ul>
                            <hr class="w-full">
                            <a href="{{ route('post', $article->slug) }}">lihat semua &raquo;</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-between items-center mt-4 bg-white rounded-lg p-4 shadow-md">
                    <div class="text-sm text-gray-600">
                        <!-- Display current page item range -->
                        Menampilkan artikel {{ $articles->firstItem() }} hingga {{ $articles->lastItem() }} dari
                        {{ $articles->total() }} artikel
                    </div>

                    <!-- Custom Pagination -->
                    <nav class="pagination">
                        {{ $articles->onEachSide(1)->links('components.pagination') }}
                    </nav>
                </div>
            </div>
        </div>
    @endif

</x-app-layout>
