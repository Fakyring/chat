<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversations extends Model {
    public $timestamps = false;
    protected $table = "convers";
    protected $primaryKey = "id_convers";
    protected $fillable = [
        'id_convers',
        'id_creator',
        'name',
        'private',
        'description'
    ];
}
