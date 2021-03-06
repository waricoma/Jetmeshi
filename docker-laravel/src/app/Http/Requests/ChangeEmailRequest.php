<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeEmailRequest extends FormRequest
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
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
            ],
            [
                'email.unique' => '入力されたメールアドレスは使用されています。',
            ],
            ];
  }

  public function new_email()
  {
    return $this->input('new_email');
  }
}
