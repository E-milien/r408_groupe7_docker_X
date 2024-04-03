<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $table = "followers";
    protected $primaryKey = ["follower_id","followed_id"];
    public $incrementing = false;
    public $timestamps = false;
}
