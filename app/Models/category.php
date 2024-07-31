<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\menu;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["title", "slug"];

    public function menus()

    {
        return $this->hasMany(menu::class);
    }

    public function getRouteKeyName()
    {
        return "slug";
    }
}
