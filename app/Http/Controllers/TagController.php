<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny',Tag::class);
        $tag= Tag::all();
        return view("tag.index",compact('tag'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /* $this->authorize('create',Tag::class); */
        return view("tag.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name'=>'required']);
            $tag=new Tag;
            $tag->create(['name'=>$request['name']]);
            return redirect()->route('showAllTags');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        $this->authorize('view',$tag);
        return view("tag.show")->with("tag",$tag);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        /* $this->authorize('update',$tag); */
        return view("tag.edit")->with("tag",$tag);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name'=>'required',
            ]);
            $tag->update(
            [  'name'=>$request['name'],
            ]);
            return redirect()->route('showAllTags')->with("success","post add successfully");

    }

    public function destroy(Tag $tag)
    {

        /* $this->authorize('delete',$tag); */
        $tag->delete();
        return redirect()->route('showAllTags')->with("success","tag Delete successfully");
    }
}
