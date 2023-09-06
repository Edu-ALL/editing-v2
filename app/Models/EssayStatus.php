<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EssayStatus extends Model
{
    use HasFactory;

    protected $table = "tbl_essay_status";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_essay_clients',
        'status',
        'created_at'
    ];

    public function essay_clients()
    {
        return $this->belongsTo(EssayClients::class, 'id_essay_clients', 'id_essay_clients');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status', 'id');
    }
    public function check_status()
    {
        return $this->belongsTo(Status::class, 'status', 'id');
    }
}
