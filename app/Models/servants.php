<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class servants extends Model
{
    protected $fillable=["name" , "adress"];
    public function sales() {
        return $this->hasMany(sales::class);
    }
}
