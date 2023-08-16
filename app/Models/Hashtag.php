<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    use HasFactory;
    protected $table = 'tbl_hashtag';
    protected $fillable = ['id','hashtag','hashcount','updated_at','created_at'];
}
