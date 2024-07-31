<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
     return view("managments.categories.index")->with([
        "categories"=>Category::simplepaginate(5)
     ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("managments.categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */


public function store(Request $request)
{
    //validation
    $request->validate([
        "title" => "required|min:3"
    ]);

    //store data
    $title = $request->input('title');
    Category::create([
        "title" => $title,
        "slug" => Str::slug($title)
    ]);

    //redirect user
    return redirect()->route("categories.index")->with([
        "success" => "catégorie ajoutée avec succés"
    ]);
}

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        return view("managments.categories.edit")->with([
            "category"=> $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Category $category)
    {
        //validation
        $request->validate([
            "title" => "required|min:3"
        ]);

        //store data
        $title = $request->input('title');
        $category->update([
            "title" => $title,
            "slug" => Str::slug($title)
        ]);

        //redirect user
        return redirect()->route("categories.index")->with([
            "success" => "catégorie modifiée avec succés"
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */


     public function destroy(Category $category)
     {
         $to_delete = Category::findOrFail($category->id); // استخراج الفئة باستخدام المعرف
         $to_delete->delete();


         return redirect()->route("categories.index")->with([
             "success" => "Catégorie supprimée avec succès"
         ]);
     }


}
