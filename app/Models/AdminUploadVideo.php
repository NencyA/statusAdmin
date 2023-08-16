<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUploadVideo extends Model
{
    use HasFactory;
    protected $table = 'tbl_uservideo';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id', 'user_email', 'filename', 'path', 'hashtag', 'description', 'created_at', 'updated_at'];
}
