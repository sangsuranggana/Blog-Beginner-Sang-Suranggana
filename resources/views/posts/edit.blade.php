<x-app-layout>
    <div class="bg-white max-w-7xl mx-auto border-2 rounded-md mt-6 p-6">
        <div class="mb-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h1 class="text-5xl text-gray-900">
                    Edit Post
                </h1>
            </div>
        </div>
        <hr class="max-w-7xl mx-auto border-2">
        <form method="post" action="{{ route('post.update', $article->slug) }}" class="flex flex-col w-3/4 py-3 px-8"
            enctype="multipart/form-data">
            @method('put')
            @csrf
            {{-- Title --}}
            <div class="mb-3">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 ">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $article->title) }}" required
                    class=" border block w-full p-2.5 bg-gray-50
                @error('title')
                border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500  
                @else
                border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
                @enderror"
                    placeholder="title">
                @error('title')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Slug --}}
            <div class="mb-3">
                <label for="slug" class="block mb-2 text-sm font-medium text-gray-900 ">Slug</label>
                <input type="text" id="slug" name="slug" value="{{ old('slug', $article->slug) }}" readonly
                    class=" border block w-full p-2.5 bg-gray-50
            @error('slug')
            border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500  
            @else
            border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
            @enderror"
                    placeholder="slug">
                @error('slug')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Category --}}
            <div class="mb-3">
                <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                <select name="category_id" id="category_id" class="w-1/4">
                    @foreach ($categories as $category)
                        @if (old('category_id', $article->category_id) == $category->id)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            {{-- Image --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900" for="image">Upload Image</label>
                <input type="hidden" name="oldImage" value="{{ $article->image }}">
                @if ($article->image)
                    <img src="{{ asset('storage/' . $article->image) }}" class="img-preview mb-3 block">
                @else
                    <img class="img-preview mb-3">
                @endif
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none p-1"
                    aria-describedby="file_input_help" id="image" name="image" type="file"
                    onchange="previewImage()">
                <p class="mt-1 text-sm text-gray-500" id="file_input_help">PNG, JPG (MAX. 8MB).</p>
                @error('image')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tag --}}
            <div class="mb-4">
                <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                <select id="tags" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    <option value="" disabled selected>Pilih Tag</option>
                    <!-- Options will be filled dynamically -->
                </select>
            </div>

            <!-- Selected Tag -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Tag yang Dipilih</label>
                <div id="selectedTags" class="border border-gray-300 rounded-md p-3 bg-gray-50">
                    @foreach ($article->tags as $tag)
                        <div class="selected-tag flex items-center mb-2">
                            <input type="hidden" name="tags[]" value="{{ $tag->id }}">
                            <span class="text-gray-800 mr-3">{{ $tag->name }}</span>
                            <button type="button"
                                class="remove-tag bg-red-500 text-white px-2 py-1 rounded">Remove</button>
                        </div>
                    @endforeach
                    <!-- Selected tagss akan tampil di sini -->
                </div>
            </div>

            {{-- Full Text --}}
            <div class="mb-3">
                <label for="full_text" class="block mb-2 text-sm font-medium text-gray-900 ">Body</label>
                @error('full_text')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
                <input id="full_text" type="hidden" name="full_text"
                    value="{{ old('full_text', $article->full_text) }}">
                <trix-editor input="full_text"></trix-editor>
            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Edit
                Post</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function() {
            fetch('/post/checkSlug?title=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });

        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        })

        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        $(document).ready(function() {
            $(document).on('click', function() {
                $.ajax({
                    url: '/get-tags',
                    method: 'GET',
                    success: function(response) {
                        $('#tags').empty(); // Kosongkan select sebelum menambahkan yang baru
                        $('#tags').append(
                            '<option value="" disabled selected>Pilih Tag</option>');
                        response.forEach(function(tag) {
                            $('#tags').append('<option value="' + tag.id + '">' +
                                tag.name + '</option>');
                        });
                    }
                });
            });

            $('#tags').on('change', function() {
                let selectedOption = $('#tags option:selected');
                let tagId = selectedOption.val();
                let tagName = selectedOption.text();

                // Cek apakah distrik sudah dipilih
                if ($('#selectedTags input[value="' + tagId + '"]').length == 0) {
                    // Tambahkan distrik yang dipilih
                    $('#selectedTags').append(`
                            <div class="selected-tag flex items-center mb-2">
                                <input type="hidden" name="tags[]" value="${tagId}">
                                <span class="text-gray-800 mr-3">${tagName}</span>
                                <button type="button" class="remove-tag bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
                            </div>
                        `);
                }
            });

            // Hapus distrik yang dipilih
            $(document).on('click', '.remove-tag', function() {
                $(this).closest('.selected-tag').remove();
            });
        });
    </script>

</x-app-layout>
