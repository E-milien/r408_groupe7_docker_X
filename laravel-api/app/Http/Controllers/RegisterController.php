<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\User; 

class RegisterController extends Controller
{
    public function authenticate(Request $request)
    {
     
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'bio' => 'nullable|string',
            'email' => 'required|string|email|max:255|unique:users',
            'pwd' => 'required|string|min:6', // Exemple de règle pour la validation du mot de passe
            'birthdate' => 'nullable|date',
            'profile_pic' => 'nullable|string',
        ]);

        // Créer un nouvel utilisateur et hasher le mot de passe
        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->pwd = Hash::make($request->pwd);
        $user->save();

        // Vous pouvez retourner une réponse JSON ou rediriger l'utilisateur vers une autre page
        return response()->json(['message' => 'Utilisateur enregistré avec succès'], 201);
      
    }
}
