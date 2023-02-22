<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//リクエストクラスを拡張してエラーメッセージを表示する
class UploadImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//基本的にtrueに設定
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()//バリデーションルールを記述
    {
        return [
            'image'=>'image|mimes:jpg,jpeg,png|max:2048',
            'files.*.image' => 'required|image|mimes:jpg,jpeg,png|max:3072',
        ];
    }

    public function messages()//バリデーションエラーが発生した際のエラーメッセージを記述
    {
    return [
      'image' => '指定されたファイルが画像ではありません。',
      'mines' => '指定された拡張子（jpg/jpeg/png）ではありません。',
      'max' => 'ファイルサイズは2MB以内にしてください。',
      ];
    }
}

//php artisan make:request UploadImageRequest