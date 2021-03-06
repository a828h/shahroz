<?php

namespace App\Http\Requests\admin\campaigns;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class updateContentRequest extends FormRequest
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
            'contents' => 'required|array|min:1',
            'contents.*.publishers' => 'required|array|min:1',
            'content.*.type' => [
                'required',
                Rule::in(['impression', 'fix']),
            ],
            'contents.*.our_cost' => 'required|numeric',
            'contents.*.customer_cost' => 'required|numeric',
            'contents.*.rows' => 'required|array|min:1',
            'contents.*.rows.*.impersion_cnt' => 'required|numeric',
            'contents.*.rows.*.reach_cnt' => 'required|numeric',
            'contents.*.rows.*.clicks_cnt' => 'required|numeric',
            'contents.*.rows.*.like_cnt' => 'required|numeric',
            'contents.*.rows.*.share_cnt' => 'required|numeric',
            'contents.*.rows.*.save_cnt' => 'required|numeric',
            'contents.*.rows.*.sticker_tap_cnt' => 'required|numeric',
            'contents.*.rows.*.comment_cnt' => 'required|numeric',
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
