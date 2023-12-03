<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversations extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "convers";
    protected $primaryKey = "id_convers";
    protected $fillable = [
        'id_creator',
        'name',
        'private',
        'description'
    ];
}
