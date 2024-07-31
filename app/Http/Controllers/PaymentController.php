<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Table;
use App\Models\menu;
use App\Models\servants;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    function index(){
    return view("payments.index")->with([
        "tables"=> Table::all(),
        "categories"=> Category::all(),
        
        "servants"=>servants::all()
     ]);
   }
}
