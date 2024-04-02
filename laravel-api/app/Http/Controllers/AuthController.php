<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Tweet;
use App\Models\User;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {

        $request->validate([
            
        ]);

        // Créer un nouvel utilisateur et hasher le mot de passe
        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->pwd = Hash::make($request->pwd);
        $user->save();

        // Vous pouvez retourner une réponse JSON ou rediriger l'utilisateur vers une autre page
        return response()->json(['message' => 'Utilisateur enregistré avec succès'], 201);
    }

    public function login(Request $request)
    {
        $user =  User::where('email', $request->email)->first();

        if ($user !== null && Hash::check($request->pwd, $user->pwd)) {
            return response()->json(['message' => 'Authentification réussie avec id', 'user_id' => $user->id], 200);
        } else {
            return response()->json(['message' => 'Email ou mot de passe incorrect'], 401);
        }
    }
}
