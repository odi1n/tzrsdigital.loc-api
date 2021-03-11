<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    //
    public function login(Request $request)
    {
        $formFields = $request->only(['login', 'password']);

        if (strpos($formFields['login'], '+7') !== false) {
            $formFields = ([
                'phone' => $formFields['login'],
                'password' => $formFields['password']
            ]);
        } else {
            $formFields = ([
                'email' => $formFields['login'],
                'password' => $formFields['password']
            ]);
        }
        $checkAuth = Auth::attempt($formFields);
        if ($checkAuth) {
            $user = Auth::user();
            $user['token'] = $user->createToken('MyApp')->accessToken;
            unset($user['password']);
            return $this->sendResponse($user, 'Авторизация удалась');
        }
        return $this->sendError('Авторизация не удалась', $checkAuth);

    }
}
