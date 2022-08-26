<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EssayFeedbacks extends Model
{
    use HasFactory;

    protected $table = "tbl_essay_feedback";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_essay_clients',
        'option1',
        'option2',
        'option3',
        'option4',
        'option5',
        'option6',
        'add_comments',
        'created_at',
    ];

    public function essay_clients()
    {
        return $this->belongsTo(EssayClients::class, 'id_essay_clients', 'id_essay_clients');
    }
}
