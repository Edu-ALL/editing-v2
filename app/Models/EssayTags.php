<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EssayTags extends Model
{
    use HasFactory;
    protected $table = "tbl_essay_tags";
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_essay_clients',
        'id_topic',
    ];

    public function tags()
    {
        return $this->belongsTo(Tags::class, 'id_topic', 'id_topic');
    }
}
