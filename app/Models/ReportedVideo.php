<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportedVideo extends Model
{
    use HasFactory;
    protected $table = 'tbl_videoreport';
    public function video()
    {
        return $this->hasOne(Video::class, 'id','video_id');
    }
}
