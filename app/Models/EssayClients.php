<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EssayClients extends Model
{
    use HasFactory;

    protected $table = "tbl_essay_clients";
    protected $primaryKey = 'id_essay_clients';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_essay_clients',
        'id_transaction',
        'id_program',
        'id_univ',
        'id_editors',
        'essay_title',
        'essay_prompt',
        'id_clients',
        'email',
        'mentors_mail',
        'essay_deadline',
        'application_deadline',
        'number_of_words',
        'attached_of_clients',
        'notes_clients',
        'essay_rating',
        'status_essay_clients',
        'status_read',
        'status_read_editor',
        'uploaded_at',
        'completed_at'
    ];

    public function editor()
    {
        return $this->belongsTo(Editor::class, 'id_editors', 'id_editors');
    }

    public function university()
    {
        return $this->belongsTo(University::class, 'id_univ', 'id_univ');
    }

    public function program()
    {
        return $this->belongsTo(Programs::class, 'id_program', 'id_program');
    }

    public function client_by_id()
    {
        return $this->belongsTo(Client::class, 'id_clients');
    }

    public function client_by_email()
    {
        return $this->belongsTo(Client::class, 'email', 'email');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_essay_clients', 'id');
    }

    public function essay_editors()
    {
        return $this->belongsTo(EssayEditors::class, 'id_essay_clients', 'id_essay_clients');
    }

    public function feedback()
    {
        return $this->belongsTo(EssayFeedbacks::class, 'id_essay_clients', 'id_essay_clients');
    }

    public function essay_tags()
    {
        return $this->belongsTo(EssayTags::class, 'id_essay_clients', 'id_essay_clients');
    }
}