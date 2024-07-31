<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class TableController extends Controller
{
    public function __construct()
    {
           $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("managments.tables.index")->with([
            "tables"=>Table::simplepaginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("managments.tables.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //validation
    $request->validate([
        "name" => "required|unique:tables,name",
        "status" => "required|boolean"
    ]);

    //store data
    $name = $request->input('name');
    Table::create([
        "name" => $name,
        "slug" => Str::slug($name),
        "status" => $request->input('status')
    ]);

    //redirect user
    return redirect()->route("tables.index")->with([
        "success" => "Table ajoutée avec succés"
    ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(table $table)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(table $table)
    {
        return view("managments.tables.edit")->with([
            "table"=>$table
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Table $table)
    {
        // التحقق من الصحة
        $request->validate([
            "name" => "required|unique:tables,name,".$table->id,
            "status" => "required|boolean"
        ]);

        // تحديث البيانات
        $table->update([
            "name" => $request->input('name'),
            "slug" => Str::slug($request->input('name')),
            "status" => $request->input('status'),
        ]);

    //redirect user
    return redirect()->route("tables.index")->with([
        "success" => "Table modifiée avec succés"
    ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Table $table)
    {

        $to_delete = Table::findOrFail($table->id);
        $to_delete->delete();


        return redirect()->route("tables.index")->with([
            "success" => "Tables supprimée avec succès"
        ]);
    }
}
