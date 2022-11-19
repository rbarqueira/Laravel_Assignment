<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class BookAPIController extends Controller
{
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
        
        $books = Book::latest()->filter(request(['tag','search']))->get();

        return response()->json([
            'status' => true,
            'books' => $books
        ]);
        
    }

    //Show single book
    public function show(Book $book) {
        return response()->json([
            'status' => true,
            'book' => $book
        ]);
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

        $book = Book::create($formFields);

        return response()->json([
            'status' => true,
            'message' => "Book Created successfully!",
            'book' => $book
        ], 200);
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

        return response()->json([
            'status' => true,
            'message' => "Book Updated successfully!",
            'book' => $book
        ], 200);
    }

    // Delete Book
    public function destroy(Book $book) {
        // Make sure logged in user is owner
        if($book->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $book->delete();

        return response()->json([
            'status' => true,
            'message' => "Book Deleted successfully!",
        ], 200);
    }

    // Manage Books
    public function manage() {

        $books = auth()->user()->books()->get();

        return response()->json([
            'status' => true,
            'books' => $books
        ]);
    }
}
