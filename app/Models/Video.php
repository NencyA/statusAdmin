<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $table = 'tbl_upload_video';
    public function user(){
        return $this->hasOne(User::class,'emailId','user_mailid');
      }

}
