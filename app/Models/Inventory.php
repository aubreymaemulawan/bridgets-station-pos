<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventory';
    protected $primaryKey = 'id';

    // INVERSE: An Inventory has many Ingredients 
    public function ingredients(){
        return $this->hasMany(Ingredients::class);
    }

    // An Inventory belongs to Branch
    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    // INVERSE: An Inventory has many Inventory Logs 
    public function inventory_logs(){
        return $this->hasMany(InventoryLogs::class);
    }
}
