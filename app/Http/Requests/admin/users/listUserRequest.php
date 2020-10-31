<?php

namespace App\Http\Requests\admin\users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class listUserRequest extends FormRequest
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
            'status' => [
                Rule::in(['', 'active', 'inactive']),
            ], 
            'role' => [
                Rule::in(['', 'super_admin', 'admin', 'member']),
            ],
        ];
    }
}
