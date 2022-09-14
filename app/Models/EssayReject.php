<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EssayReject extends Model
{
    use HasFactory;

    protected $table = "tbl_essay_reject";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_essay_clients',
        'editors_mail',
        'notes',
        'created_at'
    ];

    public function essay_clients()
    {
        return $this->belongsTo(EssayClients::class, 'id_essay_clients', 'id_essay_clients');
    }
}
