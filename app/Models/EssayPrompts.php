<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EssayPrompts extends Model
{
    use HasFactory;

    protected $table = "tbl_essay_prompt";
    protected $primaryKey = 'id_essay_prompt';

    protected $fillable = [
        'title',
        'description',
        'notes',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function university()
    {
        return $this->belongsTo(University::class, 'id_univ', 'id_univ');
    }
}
