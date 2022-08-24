<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editor extends Model
{
    use HasFactory;

    protected $table = "tbl_editors";
    protected $primaryKey = 'id_editors';
    public $incrementing = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'graduated_from',
        'major',
        'address',
        'about_me',
        'position',
        'image',
        'hours',
        'average_rating',
        'status',
        'password',
    ];

    protected $hidden = [
        'password'
    ];
}
