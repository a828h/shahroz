<?php

namespace App\Http\Requests\admin\publishers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class storePublisherRequest extends FormRequest
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
            'link' => ['required', 'max:255'],
            'platform' => [
                'required',
                Rule::in(['telegram', 'instagram']),
            ], 
            'status' => [
                'required',
                Rule::in(['new', 'active', 'inactive']),
            ],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'نام',
            'link' => 'لینک',
            'platform' => 'پلتفرم', 
            'status' => 'وضعیت',
        ];
    }
}
