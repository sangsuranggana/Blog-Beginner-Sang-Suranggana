<x-app-layout>


    <div class="bg-white max-w-7xl mx-auto border-2 rounded-md mt-6 p-6">
        <div class="mb-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h1 class="text-5xl text-gray-900">
                    Category : {{ $category->name }}
                </h1>
            </div>
        </div>
        <hr class="max-w-7xl mx-auto border-2">
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
                        <div class="flex flex-col flex-1 gap-2">
                            <h1 class="text-4xl">{{ $article->title }}</h1>
                            <p class="flex-1 line-clamp-5">{{ $article->excerpt }}</p>
                            <ul class="flex flex-wrap items-center gap-2">
                                <li class="uppercase underline">{{ $article->category->name }}</li>
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
