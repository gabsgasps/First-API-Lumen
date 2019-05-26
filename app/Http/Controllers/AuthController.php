<?php

namespace App\Http\Controllers;

use Validator;
use App\User;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function jwt(User $user) {

        $data = [
            'iss' => 'lumen-jwt',
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + 60*60
        ];

        return JWT::encode($data, env('JWT_SECRET'));
    
    } 

    public function authenticate(User $user) {

        $this->validate($this->request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $this->request->input('email'))->first();

        if (!$user) {
            return response()->json([
                'error' => 'email não existe'
            ]);
        }

        if ( 
            Hash::check( $this->request->input('password'), $user->password)
        ) {

            return response($user, 200)->header('access-token', $this->jwt($user));
        }

        return response()->json(
            [ 'error' => 'Email ou Senha Inválidos' ], 
            400
        );
    }
}
