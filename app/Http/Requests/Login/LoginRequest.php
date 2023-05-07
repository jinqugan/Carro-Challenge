<?php

namespace App\Http\Requests\Login;

use App\Http\Requests\FormRequest;
use Illuminate\Support\Facades\Auth;

class LoginRequest extends FormRequest
{
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|string|min:6|max:255|email',
            'password' => "required|min:6|max:100|checkspecialcharacter",
        ];
    }

    public function messages()
    {
        return [
            'email.required' => trans('login.email_required'),
            'email.email' => trans('login.invalid_email'),
            'password.required' => trans('login.password_required'),
            'password.checkspecialcharacter' => trans('login.password_specialchar', ['character' => config('constant.special_character')]),

        ];
    }

    public function withValidator($validator)
    {
        if ($validator->passes()) {
            $request = $this->all();
            // $credentials = $request->only('email', 'password');


            $validator->after(function ($validator) use ($request) {
                $success = Auth::attempt([
                    'email' => $request['email'],
                    'password' => $request['password'],
                ]);

                if (!$success) {
                    $validator->errors()->add('password', trans('login.invalid_credential'));
                }
            });
        }
    }
}
