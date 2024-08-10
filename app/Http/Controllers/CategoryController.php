<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $this->authorize('viewAny',Category::class);
        $cat= Category::all();
        return view("category.index",compact('cat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /* $this->authorize('create',Category::class); */
        return view("category.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'image'=>'image|mimes:jpeg,jpg,png,gif|max:2048',
            ]);
            $cat=new Category;
            if($request->hasFile('image')){
                    $img=$request['image'];
                    $imgName=time().".".$img->getClientOriginalExtension();
                    $img->move('./assets/imgs',$imgName);
                    $data['image']=$imgName;
            }
            $cat->create(
            [  'title'=>$request['title'],
                'image'=>$imgName,
            ]);
            return redirect()->route('showAllCategories')->with("success","category add successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $this->authorize('view',$category);
        return view("category.show")->with("category",$category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        /* $this->authorize('update',$category); */
        return view("category.edit")->with("category",$category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title'=>'required',
            'image'=>'image|mimes:jpeg,jpg,png,gif|max:2048|nullable',
            ]);
            $imgName=$category->image;
            if($request->hasFile('image')){
                    $img=$request['image'];
                    $imgName=time().".".$img->getClientOriginalExtension();
                    $img->move('./assets/imgs',$imgName);
                    $data['image']=$imgName;
            }
            $category->update(
            [  'title'=>$request['title'],
                'image'=>$imgName,
            ]);
            return redirect()->route('showAllCategories')->with("success","category update successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        /* $this->authorize('delete',$category); */
        $category->delete();
        return redirect()->route('showAllCategories')->with("success","category Delete successfully");

    }
}
