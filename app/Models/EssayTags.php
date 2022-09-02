<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EssayTags extends Model
{
    use HasFactory;
    protected $table = "tbl_essay_tags";
    protected $primaryKey = 'id';

    public function tags()
    {
        return $this->belongsTo(Tags::class, 'id_topic', 'id_topic');
    }
}
