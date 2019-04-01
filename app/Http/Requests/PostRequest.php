<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;


class PostAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // NOTE: routes/web.appでログインチェックしているため不要
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
            'thread_id'=>'required',
            'subject'=>'required',
            'body'=>'required'
        ];
    }

    public function messages() {
        return [
            'thread_id.required' => '正しいフォームデータではありません。',
            'subject.required' => '件名は必須です。',
            'body.required' => '本文は必須です。'
        ];
    }
}
