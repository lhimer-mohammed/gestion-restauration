<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\sales;
class menu extends Model
{
    protected $fillable=["title" , "slug", "description", "image","price" , "category_id"];
    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function getRouteKeyName(){
        return "slug";

    }
    public function sales(){
        return $this->belongsToMany(sales::class);
    }
}
