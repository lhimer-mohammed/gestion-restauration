<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function __construct()
    {
       $this->middleware("auth");
    }
    public function index()
    {
        return view("managments.menus.index")->with([
            "menus"=>menu::simplepaginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("managments.menus.create")->with([
            "categories"=>Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //validation
    $request->validate([
        "title" => "required|min:3",
        "description" => "required|min:5",
        "image" => "required|image|mimes:png,jpeg,jpg",
        "price" => "required|numeric",
        "category_id" => "required",
    ]);

    //store data
    if ($request->hasFile("image")) {
        $file=$request->image;
        $imageName=time()."_".$file->getClientOriginalName();
        $file->move(public_path('images/menus'),$imageName);
        $title = $request->input('title');
        menu::create([
        "title" =>$request->title,
        "slug" => Str::slug($title),
        "description" =>$request->description,
        "price" => $request->price,
        "category_id" =>$request->category_id,
        "image" => $imageName,
    ]);

    //redirect user
    return redirect()->route("menus.index")->with([
        "success" => "Menu ajoutée avec succés"
    ]);
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(menu $menu)
    {

        return view("managments.menus.edit")->with([
            "categories"=>Category::all(),
            "menu"=>$menu
        ]);
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, menu $menu)
    {
        // Validate input data
        $request->validate([
            "title" => "required|min:3",
            "description" => "required|min:5",
            "image" => "image|mimes:png,jpeg,jpg",
            "price" => "required|numeric",
            "category_id" => "required",
        ]);

        // Check if image file is uploaded
        if ($request->hasFile("image")) {
            // Delete old image
            $oldImagePath = public_path('images/menus/' . $menu->image);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            // Store new image
            $file = $request->file('image');
            $imageName = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('images/menus'), $imageName);

            // Update menu with new image
            $menu->update([
                "title" => $request->input('title'),
                "slug" => Str::slug($request->input('title')),
                "description" => $request->input('description'),
                "price" => $request->input('price'),
                "category_id" => $request->input('category_id'),
                "image" => $imageName,
            ]);
        } else {
            // Update menu without changing the image
            $menu->update([
                "title" => $request->input('title'),
                "slug" => Str::slug($request->input('title')),
                "description" => $request->input('description'),
                "price" => $request->input('price'),
                "category_id" => $request->input('category_id'),
            ]);
        }

        // Redirect the user
        return redirect()->route("menus.index")->with([
            "success" => "Menu Modifié avec succès"
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */



     public function destroy(menu $menu)
     {
         $imagePath = public_path('images/menus/'.$menu->image);

         // Check if the file exists before attempting to delete it
         if (File::exists($imagePath)) {
             // Delete the image file
             File::delete($imagePath);
         }

         // Delete the menu record from the database
         $menu->delete();

         // Redirect the user
         return redirect()->route("menus.index")->with([
             "success" => "Menu Supprimé avec succès"
         ]);
     }

}
