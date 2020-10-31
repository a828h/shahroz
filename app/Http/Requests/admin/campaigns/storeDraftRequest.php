<?php

namespace App\Http\Requests\admin\campaigns;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class storeDraftRequest extends FormRequest
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
            'platform' => [
                'required',
                Rule::in(['telegram', 'instagram_post', 'instagram_story']),
            ],
            'start_at' => ['required'],
            'end_at' => ['required'],
            'users' => ['required', 'array'],
            'users.*' => ['integer', 'exists:users,id'],
            'categories' => ['required', 'array'],
            'categories.*' => ['integer', 'exists:categories,id'],
            'brands' => ['required', 'array'],
            'brands.*' => ['integer', 'exists:brands,id'],
            'resource_type' => [
                'required',
                Rule::in(['none', 'campaign', 'content', 'all']),
            ]
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'نام',
            'platform' => 'پلتفرم',
            'status' => 'وضعیت',
            'start_at' => 'تاریخ شروع',
            'end_at' => 'تایخ پایان',
            'users' => 'کاربران',
            'users.*' => 'کاربر',
            'categories' => 'دسته بندی ها',
            'categories.*' => 'دسته بندی',
            'brands' => 'برند ها',
            'brands.*' => 'برند',
            'resource_type' => 'نوع محتوای کمپین',
        ];
    }
}
