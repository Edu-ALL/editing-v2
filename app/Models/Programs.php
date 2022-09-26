<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programs extends Model
{
    use HasFactory;

    protected $table = "tbl_programs";
    protected $primaryKey = 'id_program';

    protected $fillable = [
        'id_program',
        'program_name',
        'description',
        'price',
        'discount',
        'minimum_word',
        'maximum_word',
        'completed_within',
        'images',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function essay_clients()
    {
        return $this->hasMany(EssayClients::class, 'id_program', 'id_program');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }
}