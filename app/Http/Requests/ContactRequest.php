<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * 問い合わせフォームのバリデーションリクエスト。
 *
 * ユーザーから送信された問い合わせデータのバリデーションルールを定義します。
 */
class ContactRequest extends FormRequest
{
    /**
     * このリクエストを許可するかどうかを判定。
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // trueにしないとリクエストが弾かれます
    }

    /**
     * バリデーションルールを返す。
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ];
    }
}
