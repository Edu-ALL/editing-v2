<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkDuration extends Model
{
    use HasFactory;

    protected $table = "tbl_work_duration";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_essay_editors',
        'status',
        'duration',
        'date'
    ];

    public function essay_editors()
    {
        return $this->belongsTo(EssayClients::class, 'id_essay_editors', 'id_essay_editors');
    }
}
