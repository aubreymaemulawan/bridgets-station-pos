<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        "user_no",
        "branch_id",
        "name",
        "age",
        "contact_no",
        "address",
        "birthday",
        "date_started",
        "date_ended",
        "personal_email",
        "user_type",
        "status",
        "email",
        "password",
        "password_decrypted",
        "admin_user",
        "profile_name",
        "profile_path",
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // INVERSE: A User has many Invoice 
    public function invoice(){
        return $this->hasMany(Invoice::class);
    }

    // An User belongs to Branch
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
}
