<x-app-layout>
    <div class="mx-auto w-3/4 h-[30rem] relative">
        @if ($article->image)
            <img src="{{ asset('storage/' . $article->image) }}" alt="" class="w-full h-full object-cover">
        @else
            <img src="{{ asset('img/UB.jpg') }}" alt="" class="w-full h-full object-cover">
        @endif
    </div>
    <div class="w-[65%] bg-white mx-auto px-12 py-8 rounded-sm -mt-32 z-10 relative flex flex-col gap-4 shadow-2xl">
        <p>{{ $article->category->name }}</p>
        <h1 class="text-5xl font-bold uppercase">{{ $article->title }}</h1>
        <div class="flex flex-row justify-between">
            <p>Written by {{ $article->user->name }}</p>
            <p>{{ \Carbon\Carbon::parse($article->created_at)->format('F d, Y') }}</p>
        </div>
        <p class="">
            {!! $article->full_text !!}
        </p>
    </div>

</x-app-layout>
