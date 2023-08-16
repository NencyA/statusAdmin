<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadVideo extends Model
{
    use HasFactory;
    protected $table = 'tbl_upload_video';
    protected $fillable = ['id','name','profilePicLink','hashtag','description','video_file_name','language','video_like','share','download',
        'user_mailid','created_at','updated_at'];
}
