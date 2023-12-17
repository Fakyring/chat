<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserConvers extends Model
{
    public $timestamps = false;
    protected $table = "users_convers";
    protected $primaryKey = "id_user_convers";
    protected $fillable = [
        'id_user_convers',
        'id_user',
        'id_conver'
    ];
}
