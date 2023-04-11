<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Editor extends Authenticatable
{
    use HasFactory;

    protected $table = "tbl_editors";
    protected $primaryKey = 'id_editors';
    public $incrementing = false;

    protected $fillable = [
        'id_editors',
        'first_name',
        'last_name',
        'phone',
        'email',
        'graduated_from',
        'major',
        'address',
        'about_me',
        'position',
        'image',
        'hours',
        'average_rating',
        'status',
        'password',
    ];

    protected $hidden = [
        'password'
    ];

    public function essay_clients()
    {
        return $this->hasMany(EssayClients::class, 'id_editors', 'id_editors');
    }

    public function position()
    {
        return $this->belongsTo(PositionEditor::class, 'position', 'id_position');
    }

    public function essay_editors()
    {
        return $this->hasMany(EssayEditors::class, 'editors_mail', 'email');
    }

    public function scopeWithAndWhereHas($query, $relation, $constraint){
        return $query->whereHas($relation, $constraint)
                     ->with([$relation => $constraint]);
    }
}