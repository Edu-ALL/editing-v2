<?php

namespace App\Models\CRM_V2;

use App\Models\Students;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $connection = 'mysql_crm_v2';
    protected $table = 'tbl_client';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'st_id',
        'first_name',
        'last_name',
        'mail',
        'phone',
        'phone_desc',
        'dob',
        'insta',
        'state',
        'city',
        'postal_code',
        'address',
        'sch_id',
        'st_grade',
        'lead_id',
        'eduf_id',
        'event_id',
        'st_levelinterest',
        'graduation_year',
        'st_abryear',
        'st_statusact',
        'st_note',
        'st_statuscli',
        'st_password',
        'preferred_program',
    ];

    public function scopeWithAndWhereHas($query, $relation, $constraint){
        return $query->whereHas($relation, $constraint)
                     ->with([$relation => $constraint]);
    }

    
}
