<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    private string $text;

    public function rules()
    {
        return [
            'text' => 'required|string|min:6',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('comment.name_required'),
            'name.string'   => __('article.name_invalid'),
        ];
    }

    public function passedValidation()
    {
        $this->text = $this->get('text');
    }

    public function getText()
    {
        return $this->text;
    }
}
