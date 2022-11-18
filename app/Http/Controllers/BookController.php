<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    // Show all books
    public function index() {

        //$books = Book::whereBetween('rating', [1, 3]);
        //$books = Book::whereNotBetween('rating', [1, 3]);
        //$books = Book::whereIn('rating', [1,2,3]);
        /*$books = Book::where('author', '=', 'Daphnee Parker')
        ->where(function ($query) {
        $query->where('rating', '>', 1)
            ->orWhere('title', '=', 'Nisi praesentium molestiae id quaerat accusamus dolore deserunt.');
        });
        
        

        return view('books.index', ['books' => $books->filter(request(['tag','search']))->paginate(6)]);
        */
        
        return view('books.index', [
            'books' => Book::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
        
    }

    //Show single book
    public function show(Book $book) {
        return view('books.show', [
            'book' => $book
        ]);
    }

    // Show Create Form
    public function create() {
        return view('books.create');
    }

    // Store Book Data
    public function store(Request $request) {
        $formFields = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'rating' => 'required|integer|digits_between: 1,5',
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Book::create($formFields);

        return redirect('/')->with('message', 'Book created successfully!');
    }

    // Show Edit Form
    public function edit(Book $book) {
        return view('books.edit', ['book' => $book]);
    }

    // Update Book Data
    public function update(Request $request, Book $book) {
        // Make sure logged in user is owner
        if($book->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $formFields = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'rating' => 'required|integer|digits_between: 1,5',
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $book->update($formFields);

        return back()->with('message', 'Book updated successfully!');
    }

    // Delete Book
    public function destroy(Book $book) {
        // Make sure logged in user is owner
        if($book->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $book->delete();
        return redirect('/')->with('message', 'book deleted successfully');
    }

    // Manage Books
    public function manage() {
        return view('books.manage', ['books' => auth()->user()->books()->get()]);
    }
}
