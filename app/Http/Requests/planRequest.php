<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class planRequest extends FormRequest
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
            'plan_name' => 'required',
            'prefecture' => 'required',
            'planner' => 'required',
            'comment' => 'required',
            'residence_history' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0',
        ];
    }
}
