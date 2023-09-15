<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model {
    public $timestamps = false;
    protected $table = "users";
    protected $primaryKey = "id_user";

    protected $fillable = [
        'id_user',
        'login',
        'password',
        'name'
    ];

    protected $casts = [
        'password' => 'hashed'
    ];
}
