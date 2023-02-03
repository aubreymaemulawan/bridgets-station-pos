<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branch';
    protected $primaryKey = 'id';

    // INVERSE: A Branch has many Category 
    public function category(){
        return $this->hasMany(Category::class);
    }

    // INVERSE: A Branch has many Inventory 
    public function inventory(){
        return $this->hasMany(Inventory::class);
    }

    // INVERSE: A Branch has many Menu 
    public function menu(){
        return $this->hasMany(Menu::class);
    }

    // INVERSE: A Branch has many Users 
    public function user(){
        return $this->hasMany(User::class);
    }

    // INVERSE: A Branch has many Expenses 
    public function expenses(){
        return $this->hasMany(Expenses::class);
    }
}