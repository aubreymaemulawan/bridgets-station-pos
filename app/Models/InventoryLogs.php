<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryLogs extends Model
{
    protected $table = 'inventory_logs';
    protected $primaryKey = 'id';

    // An Inventory Logs belongs to Inventory
    public function inventory(){
        return $this->belongsTo(Inventory::class);
    }
}
