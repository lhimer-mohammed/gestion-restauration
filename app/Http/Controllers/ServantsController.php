<?php

namespace App\Http\Controllers;

use App\Models\servants;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateservantsRequest;

class ServantsController extends Controller
{
    public function __construct(){
    $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("managments.serveurs.index")->with([
            "servants"=>servants::simplepaginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          return view("managments.serveurs.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //validation
    $request->validate([
        "name" => "required|min:3"
    ]);

    //store data
    servants::create([
        "name" => $request->name,
        "adress" => $request->adress
    ]);

    //redirect user
    return redirect()->route("servants.index")->with([
        "success" => "serveur ajoutée avec succés"
    ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(servants $servants)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view("managments.serveurs.edit")->with([
            "servants"=> servants::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // البحث عن السجل المطلوب
        $servant = servants::findOrFail($id);
    
        // التحقق من الصحة
        $request->validate([
            "name" => "required|min:3"
        ]);
    
        // تحديث البيانات
        $servant->update([
            "name" => $request->name,
            "adress" => $request->adress // تصحيح الاخطاء في عنوان الحقل
        ]);
    
        // توجيه المستخدم
        return redirect()->route("servants.index")->with([
            "success" => "serveur modifié avec succès"
        ]);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // البحث عن الخادم المطلوب باستخدام الهوية
        $servant = Servants::findOrFail($id);
    
        // حذف الخادم
        $servant->delete();
    
        // توجيه المستخدم إلى الصفحة الرئيسية للخوادم مع رسالة نجاح
        return redirect()->route("servants.index")->with([
            "success" => "Serveur supprimé avec succès"
        ]);
    }
    
}
