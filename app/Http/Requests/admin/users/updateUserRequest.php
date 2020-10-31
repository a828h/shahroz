<?php

namespace App\Http\Requests\admin\users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class updateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->isAdmin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'mobile' => ['required', 'regex:/(09)[0-9]{9}/', 'digits:11', 'numeric'],
            'brand' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8'],
            'status' => [
                'required',
                Rule::in(['active', 'inactive']),
            ], 
            'role' => [
                'required',
                Rule::in(['super_admin', 'admin', 'member']),
            ],
        ];
    }


    public function attributes()
    {
        return [
            'first_name' => 'نام',
            'last_name' => 'نام خانوادگی',
            'email' => 'ایمیل',
            'mobile' => 'موبایل',
            'brand' => 'برند',
            'password' => 'رمز عبور',
            'status' => 'وضعیت', 
            'role' => 'نقش',
        ];
    }
}
