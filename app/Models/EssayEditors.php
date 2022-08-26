<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EssayEditors extends Model
{
    use HasFactory;

    protected $table = "tbl_essay_editors";
    protected $primaryKey = 'id_essay_editors';
    public $incrementing = false;

    protected $fillable = [
        'id_essay_editors',
        'id_essay_clients',
        'editors_mail',
        'attached_of_editors',
        'managing_file',
        'work_duration',
        'notes_editors',
        'status_essay_editors',
        'read',
        'uploaded_at',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_essay_editors', 'id');
    }

    public function essay_clients()
    {
        return $this->belongsTo(EssayClients::class, 'id_essay_clients', 'id_essay_clients');
    }

    public function editor()
    {
        return $this->belongsTo(Editor::class, 'editors_mail', 'email');
    }
}
