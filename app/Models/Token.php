<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;
    protected $table = "tbl_token";
    public $timestamps = false;

    protected $fillable = [
        'email',
        'token',
        'activated_at'
    ];
}
