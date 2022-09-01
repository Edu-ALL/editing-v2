<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;
    protected $table = "tbl_tags";
    protected $primaryKey = 'id_topic';
    public $timestamps = false;

    protected $fillable = [
        'topic_name'
    ];
}
