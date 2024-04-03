<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retweet  extends Model
{
    protected $table = "retweet";
    protected $primaryKey = ['user_id', 'tweet_id'];
    public $incrementing = false;
    public $timestamps = false;
}
