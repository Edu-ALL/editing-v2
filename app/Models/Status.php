<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $table = "tbl_status";
    public $incrementing = false;

    protected $fillable = [
        'id',
        'status_title',
        'status_desc',
        'by'
    ];

    public function essay_clients()
    {
        return $this->hasMany(EssayClients::class, 'status_essay_clients', 'id');
    }

    public function essay_editors()
    {
        return $this->hasMany(EssayEditors::class, 'status_essay_editors', 'id');
    }
}
