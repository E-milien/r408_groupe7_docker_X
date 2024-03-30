<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;

class ApiController extends Controller
{
    public function index(){
        return 'hello world';
    }

    public function getTweet(){
        return Tweet::all();
    }

    
}
