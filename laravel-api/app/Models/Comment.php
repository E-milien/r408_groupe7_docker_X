<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'comment_text',
        'user_id',
        'tweet_id',
        'created_at'
    ];
    public $timestamps = false;
}
