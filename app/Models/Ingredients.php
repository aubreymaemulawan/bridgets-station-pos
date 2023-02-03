<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredients extends Model
{
    protected $table = 'ingredients';
    protected $primaryKey = 'id';

    // An Ingredients belongs to Inventory
    public function inventory(){
        return $this->belongsTo(Inventory::class);
    }

    // An Ingredients belongs to Menu
    public function menu(){
        return $this->belongsTo(Menu::class);
    }
}
