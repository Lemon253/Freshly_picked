<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
        // リクエストのルート名を取得
        $routeName = $this->route()->getName();

        // 登録（store）時と編集（update）時でルールを切り替える
        $rules = [
            'name' => ['required'],
            'price' => ['required', 'integer', 'min:0', 'max:10000'],
            'seasons' => ['required', 'array', 'min:1'],
            'description' => ['required', 'max:120'],
        ];

        if ($routeName == 'items.store') {
            // 登録時のみimageを必須にする
            $rules['image'] = ['required', 'mimes:png,jpeg'];
        } elseif ($routeName == 'items.update') {
            // 編集時、画像がアップロードされた場合のみバリデーションを適用
            $rules['image'] = ['nullable', 'mimes:png,jpeg'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'price.required' => '値段を入力してください',
            'price.integer' => '数値で入力してください',
            'price.min:0' => '0~10000円以内で入力してください',
            'price.max:10000' => '0~10000円以内で入力してください',
            'seasons.required' => '季節を選択してください',
            'description.required' => '商品説明を入力してください',
            'description.max:120' => '120文字以内で入力してください',
            'image.required' => '商品画像を登録してください',
            'image.mimes:png,jpeg' => '「.png」または「.jpeg」形式でアップロードしてください',
        ];
    }
}
