<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    public $timestamps = false;
    protected $table = "messages";
    protected $primaryKey = "id_message";
    protected $fillable = [
        'id_message',
        'id_convers',
        'id_user',
        'text',
        'deleted'
    ];
}
