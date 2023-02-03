<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $table = 'expenses';
    protected $primaryKey = 'id';

    // An Expenses belongs to Branch
    public function branch(){
        return $this->belongsTo(Branch::class);
    }}
