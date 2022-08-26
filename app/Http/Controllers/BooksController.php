<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(){
        $books = Book::with('categories:id,title', 'tags:id,title')->paginate(10);

        return response()->json($books);
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required|string|unique:book_tags,title',
            'description' => 'required|string',
            'price' => 'required',
            'isbn' => 'required',
            'category' => 'required',
            'tag' => 'required',
        ]);
        

        $book = new Book();
        $book->title = ucwords($request->title);
        $book->description = ($request->description);
        $book->price = ($request->price);
        $book->isbn = ($request->isbn);
        $book->save();

        if($request->category){
            $book->categories()->attach($request->category);
        }
        
        if($request->tag){
            $book->tags()->attach($request->tag);
        }

        return response()->json($book);
    }

    public function show($id){
        $book = Book::find($id);

        return response()->json($book);
    }

    public function update($id, Request $request)
    {
        $book = Book::findOrFail($id);
        
        $book->title = ucwords($request->title);
        $book->description = ($request->description);
        $book->price = ($request->price);
        $book->isbn = ($request->isbn);
        $book->save();

        if($request->category){
            $book->categories()->sync($request->category);
        }
        
        if($request->tag){
            $book->tags()->sync($request->tag);
        }

        return response()->json($book, 200);
    }

    public function delete($id)
    {
        Book::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
    //
}
