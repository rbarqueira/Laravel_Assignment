<x-layout>
  <x-card class="p-10 max-w-lg mx-auto mt-24">
    <header class="text-center">
      <h2 class="text-2xl font-bold uppercase mb-1">Edit Book</h2>
      <p class="mb-4">Edit: {{$book->title}}</p>
    </header>

    <form method="POST" action="/books/{{$book->id}}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="mb-6">
        <label for="author" class="inline-block text-lg mb-2">Author Name</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="author"
          value="{{old('author')}}" />

        @error('author')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="title" class="inline-block text-lg mb-2">Book Title</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title"
          placeholder="Example: Harry Potter" value="{{old('title')}}" />

        @error('title')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="location" class="inline-block text-lg mb-2">Book Rating</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="rating"
          placeholder="Example: 1 to 5" value="{{old('rating')}}" />

        @error('location')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="tags" class="inline-block text-lg mb-2">
          Tags (Comma Separated)
        </label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags"
          placeholder="Example: Educational, Fantasy, etc" value="{{old('tags')}}" />

        @error('tags')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="logo" class="inline-block text-lg mb-2">
          Book Picture
        </label>
        <input type="file" class="border border-gray-200 rounded p-2 w-full" name="logo" />

        @error('logo')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="description" class="inline-block text-lg mb-2">
          Book Description
        </label>
        <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10"
          placeholder="Include synopsis">{{old('description')}}</textarea>

        @error('description')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <button class="bg-gray-400 text-white rounded py-2 px-4 hover:bg-black">
          Update Book
        </button>

        <a href="/" class="text-black ml-4"> Back </a>
      </div>
    </form>
  </x-card>
</x-layout>
