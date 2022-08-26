<?php

namespace App\Http\Controllers;

use App\Models\BookTag;
use Illuminate\Http\Request;

class BookTagsController extends Controller
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
        $tags = BookTag::paginate(10);

        return response()->json($tags);
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required|string|unique:book_tags,title'
        ]);
        

        $tag = new BookTag();
        $tag->title = ucwords($request->title);
        $tag->save();

        return response()->json($tag);
    }

    public function show($id){
        $tag = BookTag::find($id);

        return response()->json($tag);
    }

    public function update($id, Request $request)
    {
        $tag = BookTag::findOrFail($id);
        $tag->update($request->all());

        return response()->json($tag, 200);
    }

    public function delete($id)
    {
        BookTag::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
    //
}
