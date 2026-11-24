<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve books belonging to the logged-in administrator
    $books = auth()->user()->books()->latest()->get();

    return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // Validate the submitted book information
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'category' => 'required|in:Fiction,Nonfiction,Academic,Children\'s Books',
        'unit_price' => 'required|numeric|min:0',
        'description' => 'required|string',
        'availability_status' => 'required|in:Available,Unavailable',
    ]);

    // Associate the new book with the logged-in administrator
    $request->user()->books()->create($validated);

    return redirect()->route('books.index')
        ->with('success', 'Book added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
           // Only retrieve books belonging to the logged-in administrator
    $book = auth()->user()->books()->findOrFail($id);

    return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
         // Retrieve the book owned by the logged-in administrator
    $book = auth()->user()->books()->findOrFail($id);

    return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
         // Validate book information
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'category' => 'required|in:Fiction,Nonfiction,Academic,Children\'s Books',
        'unit_price' => 'required|numeric|min:0',
        'description' => 'required|string',
        'availability_status' => 'required|in:Available,Unavailable',
    ]);

    // Find the administrator's book
    $book = auth()->user()->books()->findOrFail($id);

    // Update the database record
    $book->update($validated);

    return redirect()->route('books.index')
        ->with('success', 'Book updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
         // Find the book belonging to the logged-in administrator
    $book = auth()->user()->books()->findOrFail($id);

    // Delete the book from the database
    $book->delete();

    return redirect()->route('books.index')
        ->with('success', 'Book deleted successfully!');
    }
}
