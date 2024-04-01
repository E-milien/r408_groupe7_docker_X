<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'tweet_text',
        'created_at'
    ];
    public $timestamps = false;
}
