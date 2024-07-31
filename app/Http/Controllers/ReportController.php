<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sales;
use Maatwebsite\Excel\Facades\Excel;
class ReportController extends Controller
{
    //
    public function __construct(){
       $this->middleware("auth");
    }
    public function index(){
        return view("reports.index");
    }
    public function generate(Request $req){
        $req->validate([
            "from"=>"required",
            "to"=>"required"
        ]);
        $startDate=date("Y-m-d H:i:s",strtotime($req->from."00:00:00"));
        $endDate=date("Y-m-d H:i:s",strtotime($req->to."23:59:59"));
        $sales = sales::whereBetween("created_at",[$startDate,$endDate])->where("payment_status","paid")->get();
        return view("reports.index",[
            "startDate"=>$startDate,
            "endDate"=>$endDate,
            "total"=>$sales->sum('total_received'),
            "sales"=>$sales
        ]);
    }

    public function export(Request $req){}
}
