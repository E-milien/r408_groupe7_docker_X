<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Followers extends Model
{
    protected $table = "followers";
    protected $primaryKey = "follower_id,followed_id";
    public $timestamps = false;
}
