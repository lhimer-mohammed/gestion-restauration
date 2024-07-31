<?php

namespace App\Http\Controllers;

use App\Models\sales;
use App\Models\servants;

use Illuminate\Http\Request;

class SalesController extends Controller
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
        //
        $sales = sales::orderBy("created_at","DESC")->simplepaginate(10);
        return view("sales.index")->with([
            "sales"=> $sales
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validation
         $request->validate([
            'table_id' => 'required',
            'menu_id' => 'required',
            'servant_id' => 'required|integer',
            'quantity' => 'required|numeric',
            'total_price' => 'required|numeric',
            'total_received' => 'required|numeric',
            'change' => 'required|numeric',
            'payment_type' => 'required|string',
            'payment_status' => 'required|string',
        ]);

        // Create a new sale instance and fill it with validated data
        $sale = Sales::create($request->all()

    );

        // Sync relations
        $sale->menus()->sync($request['menu_id']);
        $sale->tables()->sync($request['table_id']);

        // Redirect user with success message
        return redirect()->back()->with([
            'success' => 'Paiment effectué avec succès'
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function show(sales $sales)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
           //get sale to update
           $sales= sales::findOrFail($id);
          //get sale table
          $tables=$sales->tables()->where('sales_id',$sales->id)->get();
          //get table menus
          $menus=$sales->menus()->where('sales_id',$sales->id)->get();
          return view("sales.edit")->with([
              "tables"=>$tables,
              "menus"=>$menus,
              "sale"=>$sales,
              "servants"=>servants::all()
          ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validation
        $validatedData = $request->validate([
            'table_id' => 'required|array',
            'table_id.*' => 'required|integer',
            'menu_id' => 'required|array',
            'menu_id.*' => 'required|integer',
            'servant_id' => 'required|integer',
            'quantity' => 'required|numeric',
            'total_price' => 'required|numeric',
            'total_received' => 'required|numeric',
            'change' => 'required|numeric',
            'payment_type' => 'required|string',
            'payment_status' => 'required|string',
        ]);

        // Find the sale by ID
        $sale = sales::findOrFail($id);


        // Update sale data
        $sale->update($validatedData);

        // Sync relations

        $sale->menus()->sync($validatedData['menu_id']);
        $sale->tables()->sync($validatedData['table_id']);

        // Redirect user with success message
        return redirect()->back()->with(['success' => 'Paiment modifié avec succès']);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $sale = sales::findOrFail($id);
        $sale->delete();
        // Redirect user with success message
        return redirect()->back()->with(['success' => 'Paiment supprimé avec succès']);

    }
}
