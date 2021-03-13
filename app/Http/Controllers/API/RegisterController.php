<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Validator;


class RegisterController extends BaseController
{
    //
    /**
     * Register api
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'last_name' => ['required', 'string', 'max:50'],
            'first_name' => ['required', 'string', 'max:50'],
            'patronymic' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'phone' => ['required', 'string', 'regex:/\+7[0-9]{10}/', 'max:12', 'unique:users'],
            'password' => ['required', 'string', 'min:6',
                'regex:/(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{6,}/'],
            'password_confirm' => ['min:6']
        ]);

        if ($validator->fails()) {
            return $this->sendError('Ошибка валидации.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;

        return $this->sendResponse($success, 'Пользователь успешно зарегистрировался.');
    }
}
