<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagingFeedback extends Model
{
    use HasFactory;
    protected $table = "tbl_managing_feedback";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'id_essay_editor',
        'feedback',
        'id_editor',
        'created_at',
    ];

    public function essay_editor()
    {
        return $this->belongsTo(EssayEditors::class, 'id_essay_editors', 'id_essay_editor');
    }

    public function editor()
    {
        return $this->belongsTo(Editor::class, 'id_editors', 'id_editor');
    }
}
