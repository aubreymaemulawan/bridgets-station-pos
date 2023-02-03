<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';
    protected $primaryKey = 'id';

    // An Invoice belongs to User
    public function user(){
        return $this->belongsTo(User::class);
    }

    // INVERSE: An Invoice has many Sales 
    public function sales(){
        return $this->hasMany(Sales::class);
    }

    // INVERSE: An Invoice has many Transaction 
    public function transaction(){
        return $this->hasMany(Transaction::class);
    }
}
