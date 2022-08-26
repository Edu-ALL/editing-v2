<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $table = "tbl_universities";
    protected $primaryKey = 'id_univ';

    protected $fillable = [
        'university_name',
        'website',
        'univ_email',
        'phone',
        'photo',
        'address',
        'country',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function getWebsiteAttribute($value)
    {
        return $value != NULL ? $value : "-";
    }

    public function getPhoneAttribute($value)
    {
        return $value != NULL ? $value : "-";
    }

    public function getAddressAttribute($value)
    {
        return $value != NULL ? strip_tags($value) : "-";
    }

    public function essay_clients()
    {
        return $this->hasMany(EssayClients::class, 'id_univ', 'id_univ');
    }
}
