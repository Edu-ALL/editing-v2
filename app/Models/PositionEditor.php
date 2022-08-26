<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionEditor extends Model
{
    use HasFactory;

    protected $table = "tbl_position_editors";
    protected $primaryKey = 'id_position';
    public $incrementing = false;

    protected $fillable = [
        'id_position',
        'position_name'
    ];

    public function editor()
    {
        return $this->hasMany(Editor::class, 'id_position', 'position');
    }
}
