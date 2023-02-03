<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id';

    // INVERSE: A Menu has many Ingredients 
    public function ingredients(){
        return $this->hasMany(Ingredients::class);
    }

    // An Menu belongs to Branch
    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    // An Menu belongs to Category
    public function category(){
        return $this->belongsTo(Category::class);
    }

    // INVERSE: An Menu has many Sales 
    public function sales(){
        return $this->hasMany(Sales::class);
    }
}
