<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $primaryKey = 'id';

    // A Transaction belongs to Invoice
    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
}
