<?php

namespace App\Models\CRM_V2;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $connection = 'mysql_crm_v2';
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'uuid',
        'nip',
        'extended_id',
        'first_name',
        'last_name',
        'address',
        'email',
        'email_verified_at',
        'phone',
        'emergency_contact',
        'datebirth',
        'position_id',
        'password',
        'hiredate',
        'nik',
        'idcard',
        'cv',
        'bankname',
        'bankacc',
        'npwp',
        'tax',
        'active',
        'health_insurance',
        'empl_insurance',
        'export',
        'notes',
        'remember_token',
    ];
}
