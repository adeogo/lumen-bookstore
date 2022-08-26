<?php

namespace App\Http\Controllers;

use App\Models\BookCategory;
use Illuminate\Http\Request;

class BookCategoriesController extends Controller
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
        $categories = BookCategory::paginate(10);

        return response()->json($categories);
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required|string|unique:book_categories,title'
        ]);
        

        $category = new BookCategory();
        $category->title = ucwords($request->title);
        $category->save();

        return response()->json($category);
    }

    public function show($id){
        $bookCategory = BookCategory::find($id);

        return response()->json($bookCategory);
    }

    public function update($id, Request $request)
    {
        $bookCategory = BookCategory::findOrFail($id);
        $bookCategory->update($request->all());

        return response()->json($bookCategory, 200);
    }

    public function delete($id)
    {
        BookCategory::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
    //
}
