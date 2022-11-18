<x-layout>
  @if (!Auth::check())
    @include('partials._hero')
  @endif

  @include('partials._search')

  <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

    @unless(count($books) == 0)

    @foreach($books as $book)
    <x-book-card :book="$book" />
    @endforeach

    @else
    <p>No books found</p>
    @endunless

  </div>

  <div class="mt-6 p-4">
    {{$books->links()}}
  </div>
</x-layout>
