<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HastagCategory extends Model
{
    use HasFactory;
    protected $table = "tbl_category";
    public $timestamps = false;
    protected $fillable = [
        'name',
        'hashtag',
    ];
}
