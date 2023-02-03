<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'id';

    // An Sales belongs to Invoice
    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }

    // An Sales belongs to Menu
    public function menu(){
        return $this->belongsTo(Menu::class);
    }
}
