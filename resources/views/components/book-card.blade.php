@props(['book'])

<x-card>
  <div class="flex">
    <img class="hidden w-48 mr-6 md:block"
      src="{{$book->logo ? asset('storage/' . $book->logo) : asset('/images/logo.png')}}" alt="" />
    <div>
      <h3 class="text-2xl">
        <a href="/books/{{$book->id}}">{{$book->title}}</a>
      </h3>
      <div class="text-xl font-bold mb-4">{{$book->author}}</div>
      <x-book-tags :tagsCsv="$book->tags" />
      <div class="text-lg mt-4">
        <i class="fa-solid fa-star"></i> {{$book->rating}}
      </div>
    </div>
  </div>
</x-card>