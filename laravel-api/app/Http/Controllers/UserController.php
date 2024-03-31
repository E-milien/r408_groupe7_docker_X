<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getUser()
    {
        return User::all();
    }

    public function getById($id)
    {
        return User::findOrFail($id);
    }

    public function updateUser(Request $request, $id)
    {
        $task = User::findOrFail($id);
        return $task->update($request->all());
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
    }
}
