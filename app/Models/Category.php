<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'id';

    // A Category belongs to Branch
    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    // INVERSE: A Category has many Menu 
    public function menu(){
        return $this->hasMany(Menu::class);
    }
}
