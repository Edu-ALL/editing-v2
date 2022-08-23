<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;

    protected $table = "tbl_mentors";
    protected $primaryKey = 'id_mentors';
    public $incrementing = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'graduated_from',
        'address',
        'is_mentor',
        'status',
        'password',
    ];

    protected $hidden = [
        'password'
    ];

    public function mentees()
    {
        return $this->hasMany(Client::class, 'id_mentor', 'id_mentors');
    }
}
