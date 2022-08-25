<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "tbl_categories";
    protected $primaryKey = 'id_category';

    protected $fillable = [
        'category_name'
    ];

    public function program()
    {
        return $this->hasMany(Programs::class, 'id_category', 'id_category');
    }
}
