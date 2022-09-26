<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = "tbl_clients";
    protected $primaryKey = 'id_clients';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_clients',
        'first_name',
        'last_name',
        'phone',
        'email',
        'birthdate',
        'country',
        'state',
        'city',
        'postal_code',
        'address',
        'id_mentor',
        'id_mentor_2',
        'current_school',
        'school_name',
        'curriculum',
        'year',
        'image',
        'personal_brand',
        'interests',
        'personalities',
        'resume',
        'questionnaire',
        'others',
        'role',
        'status',
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $hidden = [
        'password'
    ];

    public function mentors()
    {
        return $this->belongsTo(Mentor::class, 'id_mentor', 'id_mentors');
    }

    public function essay_clients_by_id()
    {
        return $this->hasMany(EssayClients::class, 'id_clients', 'id_clients');
    }

    public function essay_clients_by_email()
    {
        return $this->hasMany(EssayClients::class, 'email', 'email');
    }
}
