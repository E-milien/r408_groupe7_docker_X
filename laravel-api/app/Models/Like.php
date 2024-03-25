<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like  extends Model
{
    protected $table = "like";
    protected $primaryKey = "user_id,tweet_id";
    public $timestamps = false;
}
