<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Cart;

class cartRequest extends FormRequest
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
        $item = (new Cart)->findItem($this);
        return [
            'count' => "integer|numeric|min:1|max:{$item->stock}"
        ];
    }

    public function messages()
    {
        return [
            'count.max' => '在住以上の選択はできません',
        ];
    }
}
