<?php

namespace App\Http\Requests\admin\brands;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class storeBrandRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['integer', 'exists:categories,id'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'نام',
            'category_id' => 'دسته بندی',
        ];
    }
}
