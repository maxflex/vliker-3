<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use App\Utils\Url;
use Illuminate\Contracts\Validation\Validator;
use App\Models\Task\Type;
use User;

class StoreRequest extends FormRequest
{
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
            'original_url' => [
                'bail',
                'required',
                function ($attribute, $value, $fail) {
                    if (preg_match('#^http[s]?\:\/\/[m]?[\.]?vk.com#', $value) === 0) {
                        return $fail(trans('validation.task.wrong_host'));
                    }
                },
                function ($attribute, $value, $fail) {
                    if (! User::loggedIn()) {
                        return $fail(trans('validation.task.not_logged_in'));
                    }
                },
            ],
            'type' => [
                function ($attribute, $value, $fail) {
                    if (! Type::isValid($value)) {
                        $fail(trans('validation.task.wrong_type'));
                    }
                },
            ],
        ];
    }

    public function messages()
    {
        return [
            'required' => trans('validation.task.required'),
        ];
    }
}
